<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddArticalRequest;
use App\Http\Requests\Api\UpdateArticalRequest;
use App\Http\Resources\ArticalResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\ArticalTrait;
use App\Http\Traits\UploadTrait;
use App\Models\Artical;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticalController extends Controller
{
    use UploadTrait;
    use ArticalTrait;
    use ApiResponseTrait;
    private $articalModel;


    public function __construct(Artical $artical)
    {
        $this->articalModel = $artical;
    }

    public function index()
    {
        $articals = $this->articalModel::get();
        return ArticalResource::collection($articals);
    }

    public function store(AddArticalRequest $request)
    {
        $this->authorize('create', $this->articalModel);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $this->uploadFile($image, 'articals/images/', $imageName);
        }
        $artical = $this->articalModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imageName
        ]);
        return $this->success([
            'category' => $artical,
            'message' => 'Artical Created Successfully',
            'code' => JsonResponse::HTTP_CREATED
        ]);
    }


    public function update(UpdateArticalRequest $request, Artical $artical)
    {
        $this->authorize('update', $this->articalModel);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $this->uploadFile($image, 'articals/images/', $imageName, 'storage/articals/images/' . $artical->image);
        }
        $artical->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => (isset($imageName)) ? $imageName : $artical->image
        ]);
        return $this->success([
            'category' => $artical,
            'message' => 'Artical Created Successfully',
            'code' => JsonResponse::HTTP_NO_CONTENT
        ]);
    }

    public function destroy(Artical $artical)
    {
        $this->authorize('delete', $this->articalModel);
        $artical->delete();
        if ($artical->image) {
            $this->deleteFile('storage/articals/images/' . $artical->image);
        }
        return $this->success('', 'Artical Deleted Successfully', JsonResponse::HTTP_OK);
    }
}
