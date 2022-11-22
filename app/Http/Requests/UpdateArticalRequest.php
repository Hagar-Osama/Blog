<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticalRequest extends FormRequest
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
            'articalId' => 'required|exists:articals,id'
        ];
    }
}
