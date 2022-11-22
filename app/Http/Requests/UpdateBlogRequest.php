<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required|min:3|max:200',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:png,jpg,svg,pneg',
            'blog_id' => 'required|exists:blogs,id'
        ];
    }
}
