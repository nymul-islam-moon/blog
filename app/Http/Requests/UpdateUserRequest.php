<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        return  [
            'status'        => ['required','integer'],
            'is_admin'      => ['required','integer'],
            'gender'        => ['required', 'integer'],
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'address'       => ['sometimes', 'nullable', 'string', 'max:255'],
            'image'         => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'phone'         => ['required', 'string', 'max:11', 'min:11', 'unique:users,phone,' . $this->user->id],
        ];
    }
}
