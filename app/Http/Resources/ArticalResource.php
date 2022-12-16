<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
                'image' => $this->image,
                'description' => $this->description,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at

            ],
            'relationships' => [
                'id' => (string) $this->id,
                'category name' => $this->category->name
            ]
        ];
    }
}
