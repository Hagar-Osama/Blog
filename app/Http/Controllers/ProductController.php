<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->index();
    }

    public function create()
    {
        return $this->productService->Create();
    }

    public function store(AddProductRequest $request)
    {
        return $this->productService->store($request);
    }

    public function edit($productId)
    {
        return $this->productService->edit($productId);
    }

    public function update(UpdateProductRequest $request)
    {
        return $this->productService->update($request);
    }

    public function destroy(DeleteProductRequest $request)
    {
        return $this->productService->destroy($request);
    }
}
