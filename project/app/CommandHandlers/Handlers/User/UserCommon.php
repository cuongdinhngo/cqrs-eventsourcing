<?php

namespace App\CommandHandlers\Handlers\User;

use Common;

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
        $request['password'] = Common::hashPassword($request['password']) ?? null;
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
            $request['password'] = Common::hashPassword($request['password']);
        }
        return $request;
    }
}