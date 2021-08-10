<?php

namespace App\Http\Controllers\User\CommandHandlers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $request['api_token'] = Str::random(80);
        return $request;
    }

    /**
     * Check plain and hashed password
     *
     * @param string $plainPassword
     * @param string $hashedPassword
     *
     * @return boolean
     */
    public function checkPassword(string $plainPassword, string $hashedPassword)
    {
        return Hash::check($plainPassword, $hashedPassword);
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