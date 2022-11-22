<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBlogRequest;
use App\Http\Requests\DeleteBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        return $this->blogService->index();
    }

    public function create()
    {
        return $this->blogService->Create();
    }

    public function store(AddBlogRequest $request)
    {
        return $this->blogService->store($request);
    }

    public function edit($blogId)
    {
        return $this->blogService->edit($blogId);
    }

    public function update(UpdateBlogRequest $request)
    {
        return $this->blogService->update($request);
    }

    public function destroy(DeleteBlogRequest $request)
    {
        return $this->blogService->destroy($request);
    }
}
