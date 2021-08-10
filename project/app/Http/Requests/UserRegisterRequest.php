<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class UserRegisterRequest extends ApiRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "email" => "bail|required|email|unique:users,email",
            "password" => "required|min:6",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "User's name is required!",
            'email.required' => 'Email is required!',
            'email.unique' => 'This Email address is already used!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password is too short',
        ];
    }
}
