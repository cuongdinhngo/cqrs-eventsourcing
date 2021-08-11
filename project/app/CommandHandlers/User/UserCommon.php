<?php

namespace App\CommandHandlers\User;

use Illuminate\Support\Facades\Hash;

class UserCommon
{
    /**
     * Prepare data for storing user
     *
     * @param array $request
     *
     * @return array
     */
    public function prepareData(array $request)
    {
        $request['password'] = Hash::make($request['password']) ?? null;
        $request['api_token'] = generateApiToken();
        return $request;
    }

    /**
     * Prepare data for updating
     *
     * @param array $request
     *
     * @return array
     */
    public function prepareUpdateData(array $request)
    {
        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }
        return $request;
    }
}