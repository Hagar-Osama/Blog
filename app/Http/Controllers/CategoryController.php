<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $CategoryService;

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }

    public function index()
    {
        return $this->CategoryService->index();
    }

    public function create()
    {
        return $this->CategoryService->Create();
    }

    public function store(AddCategoryRequest $request)
    {
        return $this->CategoryService->store($request);
    }

    public function edit($categoryId)
    {
        return $this->CategoryService->edit($categoryId);
    }

    public function update(UpdateCategoryRequest $request)
    {
        return $this->CategoryService->update($request);
    }

    public function destroy(DeleteCategoryRequest $request)
    {
        return $this->CategoryService->destroy($request);
    }
}
