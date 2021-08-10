<?php

namespace App\Http\Controllers\User\CommandHandlers;

use App\Repositories\User\UserRepository;
use Illuminate\Auth\Events\Registered;

class UserRegisterCommand
{
    public $userCommon;

    public function __construct(UserCommon $userCommon)
    {
        $this->userCommon = $userCommon;
    }

    /**
     * Handle registering user
     *
     * @param UserRepository $userRepository
     * @param array $request
     *
     * @return boolean
     */
    public function handle(UserRepository $userRepository, array $request)
    {
        $data = $this->userCommon->prepareData($request);
        if ($user = $userRepository->create($data)) {
            event(new Registered($user));
            return true;
        }
        return false;
    }
}