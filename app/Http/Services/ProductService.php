<?php

namespace App\Http\Services;

use App\Http\Controllers\ProductController;
use App\Http\Traits\ProductTrait;
use App\Http\Traits\UploadTrait;
use App\Models\Product;
use Exception;

class ProductService extends ProductController
{

    use UploadTrait;
    use ProductTrait;

    private $productModel;


    public function __construct(Product $product)
    {
        $this->productModel = $product;

    }

    public function index()
    {
        $products = $this->productModel::get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', $this->productModel);
        return view('product.create');
    }

    public function store($request)
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->hashName();
                $this->uploadFile($image, 'products/images/', $imageName);
            }
            $this->productModel::create([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'image' => $imageName
            ]);
            session()->flash('message', 'Product Created Successfully');
            return redirect()->route('product.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($productId)
    {
        $this->authorize('update', $this->productModel);

        $product = $this->getProductById($productId);
        return view('product.edit', compact('product'));
    }

    public function update($request)
    {
        try {
            $product = $this->getProductById($request->productId);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->hashName();
                $this->uploadFile($image, 'products/images/', $imageName, 'storage/products/images/'. $product->image);
            }
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'image' => (isset($imageName)) ? $imageName : $product->image
            ]);
            session()->flash('message', 'Product Updated Successfully');
            return redirect()->route('product.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $this->authorize('delete', $this->productModel);

        $product = $this->getProductById($request->productId);
        $product->delete();
        if($product->image) {
            $this->deleteFile('storage/products/images/'. $product->image);
        }
        session()->flash('message', 'Product Deleted Successfully');
        return redirect()->route('product.index');
    }
}
