<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'         => ['required', 'string', 'min:11', 'unique:users'],
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
            'first_name.required'     => 'User first name must be required',
            'last_name.required'     => 'User last name must be required',
            'email.required'     => 'User email must be required',
            'email.unique'       => 'User email already exists',
            'phone.required'     => 'User phone must be required',
            'phone.unique'       => 'User phone already exists',
            'status.integer'    => 'Select a valid option',
            'gender.integer'    => 'Select a valid gender',
            'is_admin.integer'    => 'Select a valid option',
        ];
    }
}
