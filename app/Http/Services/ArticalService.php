<?php

namespace App\Http\Services;

use App\Http\Controllers\ArticalController;
use App\Http\Traits\ArticalTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\UploadTrait;
use App\Models\Artical;
use App\Models\Category;
use Exception;

class ArticalService extends ArticalController
{

    use UploadTrait;
    use CategoryTrait;
    use ArticalTrait;
    private $articalModel;
    private $categoryModel;


    public function __construct(Artical $artical, Category $category)
    {
        $this->articalModel = $artical;
        $this->categoryModel = $category;

    }

    public function index()
    {
        $articals = $this->articalModel::get();
        return view('artical.index', compact('articals'));
    }

    public function create()
    {
        $categories = $this->getAllCategories();
        return view('artical.create', compact('categories'));
    }

    public function store($request)
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->hashName();
                $this->uploadFile($image, 'articals/images/', $imageName);
            }
            $this->articalModel::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image' => $imageName
            ]);
            session()->flash('message', 'Artical Created Successfully');
            return redirect()->route('artical.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($articalId)
    {
        $artical = $this->getArticalById($articalId);
        $categories = $this->getAllCategories();
        return view('artical.edit', compact('artical', 'categories'));
    }

    public function update($request)
    {
        try {
            $artical = $this->getArticalById($request->articalId);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->hashName();
                $this->uploadFile($image, 'articals/images/', $imageName, 'storage/articals/images/'. $artical->image);
            }
            $artical->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image' => (isset($imageName)) ? $imageName : $artical->image
            ]);
            session()->flash('message', 'Artical Updated Successfully');
            return redirect()->route('artical.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $artical = $this->getArticalById($request->articalId);
        $artical->delete();
        if($artical->image) {
            $this->deleteFile('storage/articals/images/'. $artical->image);
        }
        session()->flash('message', 'Artical Deleted Successfully');
        return redirect()->route('artical.index');
    }
}
