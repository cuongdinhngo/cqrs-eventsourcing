<?php

namespace App\CommandHandlers\Handlers\User;

use Illuminate\Auth\Events\Registered;
use App\Contracts\Command;
use App\Facades\UserRepository;

class UserUpdateCommand implements Command
{
    public $userCommon;

    public function __construct(UserCommon $userCommon)
    {
        $this->userCommon = $userCommon;
    }

    /**
     * Handle updating user
     *
     * @param array $request
     *
     * @return boolean
     */
    public function execute(array $request)
    {
        $data = $this->userCommon->prepareUpdateData($request);
        if ($user = UserRepository::update($request['id'], $data)) {
            if (isset($request['email'])) {
                event(new Registered($user));
            }
            return true;
        }
        return false;
    }
}