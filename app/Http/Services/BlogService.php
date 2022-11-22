<?php

namespace App\Http\Services;

use App\Http\Controllers\BlogController;
use App\Http\Traits\BlogTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\UploadTrait;
use App\Models\Blog;
use App\Models\Category;
use Exception;

class BlogService extends BlogController
{

    use UploadTrait;
    use CategoryTrait;
    use BlogTrait;
    private $blogModel;
    private $categoryModel;


    public function __construct(Blog $blog, Category $category)
    {
        $this->blogModel = $blog;
        $this->categoryModel = $category;

    }

    public function index()
    {
        $blogs = $this->blogModel::get();
        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = $this->getAllCategories();
        return view('blog.create', compact('categories'));
    }

    public function store($request)
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->hashName();
                $this->uploadFile($image, 'blogs/images/', $imageName);
            }
            $this->blogModel::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image' => $imageName
            ]);
            session()->flash('message', 'Blog Created Successfully');
            return redirect()->route('blog.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($blogId)
    {
        $blog = $this->getBlogById($blogId);
        $categories = $this->getAllCategories();
        return view('blog.edit', compact('blog', 'categories'));
    }

    public function update($request)
    {
        try {
            $blog = $this->getBlogById($request->blog_id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->hashName();
                $this->uploadFile($image, 'blogs/images/', $imageName, 'storage/blogs/images/'. $blog->image);
            }
            $blog->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image' => (isset($imageName)) ? $imageName : $blog->image
            ]);
            session()->flash('message', 'Blog Updated Successfully');
            return redirect()->route('blog.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $blog = $this->getBlogById($request->blog_id);
        $blog->delete();
        if($blog->image) {
            $this->deleteFile('storage/blogs/images/'. $blog->image);
        }
        session()->flash('message', 'Blog Deleted Successfully');
        return redirect()->route('blog.index');
    }
}
