<?php

namespace App\CommandHandlers\Handlers\User;

use Illuminate\Auth\Events\Registered;
use App\Contracts\Command;
use Cuongnd88\LaraAssistant\Facades\CommonUsage;
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
            $item['password'] = CommonUsage::hashPassword($item['password']);
            $item['api_token'] = generateApiToken();
            return $item;
        }, $request);
        event(new BatchUsersRegister($data));
        return true;
    }
}