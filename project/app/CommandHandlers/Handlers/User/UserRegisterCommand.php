<?php

namespace App\CommandHandlers\Handlers\User;


use App\Contracts\User as UserContract;
use Illuminate\Auth\Events\Registered;
use App\Contracts\Command;
use Illuminate\Database\Eloquent\Model;
use App\Facades\UserRepository;

class UserRegisterCommand implements Command
{
    public $userCommon;

    public function __construct(UserCommon $userCommon)
    {
        $this->userCommon = $userCommon;
    }

    /**
     * Handle registering user
     *
     * @param array $request
     *
     * @return boolean
     */
    public function execute(array $request)
    {
        $data = $this->userCommon->prepareData($request);
        if ($user = $this->createUser($data)) {
            event(new Registered($user));
            return true;
        }
        return false;
    }

    /**
     * Create new user
     *
     * @param array $data
     * @return Model
     */
    public function createUser(array $data)
    {
        return UserRepository::create($data);
    }
}