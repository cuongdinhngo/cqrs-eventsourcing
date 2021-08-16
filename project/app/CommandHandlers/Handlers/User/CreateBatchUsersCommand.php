<?php

namespace App\CommandHandlers\Handlers\User;

use Illuminate\Auth\Events\Registered;
use App\Contracts\Command;
use App\Facades\UserRepository;
use App\Facades\Common;
use App\Events\BatchUsersRegister;

class CreateBatchUsersCommand implements Command
{
    /**
     * Handle updating user
     *
     * @param array $request
     *
     * @return boolean
     */
    public function execute(array $request)
    {
        $data = array_map(function($item){
            $item['password'] = Common::hashPassword($item['password']);
            $item['api_token'] = generateApiToken();
            return $item;
        }, $request);
        event(new BatchUsersRegister($data));
        return true;
    }
}