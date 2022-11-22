<?php

namespace App\Http\Services;

use App\Http\Controllers\CategoryController;
use App\Http\Traits\CategoryTrait;
use App\Models\Category;
use Exception;

class CategoryService extends CategoryController
{

    use CategoryTrait;
    private $categoryModel;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function index()
    {
        $categories = $this->getAllCategories();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store($request)
    {
        try {
            $this->categoryModel::create([
                'name' => $request->name
            ]);
            session()->flash('message', 'Category Created Successfully');
            return redirect()->route('category.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($categoryId)
    {
        $category = $this->getCategoryById($categoryId);
        return view('category.edit', compact('category'));
    }

    public function update($request)
    {
        try {
            $category = $this->getCategoryById($request->category_id);

            $category->update([
                'name' => $request->name
            ]);
            session()->flash('message', 'Category Updated Successfully');
            return redirect()->route('category.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
            $this->getCategoryById($request->category_id)->delete();
            session()->flash('message', 'Category Deleted Successfully');
            return redirect()->route('category.index');

    }
}
