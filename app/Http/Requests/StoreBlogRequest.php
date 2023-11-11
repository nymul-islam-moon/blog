<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'title'                 => 'required|string|min:3|max:100|unique:blogs,title',
            'image'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status'                => 'required|integer',
            'blog_category_id'      => 'required|integer',
            'desc'                  => 'required|string|min:10',
        ];
    }
}
