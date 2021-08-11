<?php

namespace App\CommandHandlers\User;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use App\CommandHandlers\CommandInterface;

class UserUpdateCommand implements CommandInterface
{
    public $userCommon;

    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, UserCommon $userCommon)
    {
        $this->userCommon = $userCommon;
        $this->userRepository = $userRepository;
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
        if ($user = $this->userRepository->update($request['id'], $data)) {
            if (isset($request['email'])) {
                event(new Registered($user));
            }
            return true;
        }
        return false;
    }
}