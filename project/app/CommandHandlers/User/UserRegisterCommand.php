<?php

namespace App\CommandHandlers\User;


use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use App\CommandHandlers\CommandInterface;
use Illuminate\Database\Eloquent\Model;

class UserRegisterCommand implements CommandInterface
{
    public $userCommon;

    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, UserCommon $userCommon)
    {
        $this->userCommon = $userCommon;
        $this->userRepository = $userRepository;
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
        return $this->userRepository->create($data);
    }
}