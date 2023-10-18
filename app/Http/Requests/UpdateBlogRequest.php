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
            'title'     => 'required|string|min:3|unique:blogs,title,' . $this->blog->id,
            'image'     => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'status'    => 'required|integer',
            'desc'      => 'required|string|min:10',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required'     => 'Blog title must be Required',
            'title.unique'       => 'Blog title Already Exists',
            'status.integer'    => 'Select a valid status',
            'desc.required'     => 'Blog Description Required',
        ];
    }

}
