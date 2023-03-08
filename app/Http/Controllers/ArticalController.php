<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddArticalRequest;
use App\Http\Requests\DeleteArticalRequest;
use App\Http\Requests\UpdateArticalRequest;
use App\Http\Services\ArticalService;
use App\Models\Artical;
use Illuminate\Http\Request;

class ArticalController extends Controller
{
    private $articalService;

    public function __construct(ArticalService $articalService)
    {
        $this->articalService = $articalService;
    }

    public function index()
    {
        return $this->articalService->index();
    }

    public function create()
    {
        return $this->articalService->Create();
    }

    public function store(AddArticalRequest $request)
    {
        return $this->articalService->store($request);
    }

    public function edit($articalId)
    {
        return $this->articalService->edit($articalId);
    }

    public function update(UpdateArticalRequest $request)
    {
        return $this->articalService->update($request);
    }

    public function destroy(DeleteArticalRequest $request)
    {
        return $this->articalService->destroy($request);
    }
}
