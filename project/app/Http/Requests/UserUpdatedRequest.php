<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class UserUpdatedRequest extends ApiRequest
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
            'id' => "required",
            "email" => "bail|email|unique:users,email",
            "password" => "min:6",
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        $request = $this->all();
        if ($this->id) {
            $request['id'] = $this->id;
        }
        return $request;
    }
}
