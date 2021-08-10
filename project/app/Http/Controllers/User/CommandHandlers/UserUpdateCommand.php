<?php

namespace App\Http\Controllers\User\CommandHandlers;

use App\Repositories\User\UserRepository;
use Illuminate\Auth\Events\Registered;

class UserUpdateCommand
{
    public $userCommon;

    public function __construct(UserCommon $userCommon)
    {
        $this->userCommon = $userCommon;
    }

    /**
     * Handle updating user
     *
     * @param UserRepository $userRepository
     * @param array $request
     *
     * @return boolean
     */
    public function handle(UserRepository $userRepository, array $request)
    {
        $data = $this->userCommon->prepareUpdateData($request);
        if ($user = $userRepository->update($request['id'], $data)) {
            if (isset($request['email'])) {
                event(new Registered($user));
            }
            return true;
        }
        return false;
    }
}