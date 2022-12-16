<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\CategoryTrait;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    use CategoryTrait;
    use ApiResponseTrait;
    private $categoryModel;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function index()
    {
        $categories = $this->getAllCategories();
        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request)
    {

        $category = $this->categoryModel::create([
            'name' => $request->name
        ]);
        return  $this->success([
            'category' => $category,
            'message' => 'Category Created Successfully',
            'code' => JsonResponse::HTTP_CREATED
        ]);
    }


    public function update(CategoryRequest $request, Category $category)
    {

        $category->update([
            'name' => $request->name
        ]);
        return  $this->success([
            'category' => $category,
            'message' => 'Category Updated Successfully',
            'code' => JsonResponse::HTTP_NO_CONTENT
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success('', 'Category Deleted Successfully', JsonResponse::HTTP_OK);
    }
}
