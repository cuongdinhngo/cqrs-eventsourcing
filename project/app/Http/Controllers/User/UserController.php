<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdatedRequest;
use App\CommandHandlers\CommandFactory;
use App\CommandHandlers\User\UserRegisterCommand;
use App\CommandHandlers\User\UserUpdateCommand;
use App\Jobs\CreateBatchUsersJob;
use App\Repositories\User\UserRepositoryInterface;
use App\Jobs\ProcessUserJobs;
use App\Models\User;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    /**
     * Store new user
     *
     * @param UserRegisterRequest $request
     *
     * @return json
     */
    public function store(UserRegisterRequest $request)
    {
        try {
            $result = app(CommandFactory::class)->handle(UserRegisterCommand::class, $request->all());
            if ($result) {
                return $this->responseSuccess(['message' => 'Created Successfully']);
            }
        } catch (\Exception $e) {
            report($e);
        }
        return $this->responseError("Failed Register New User", 500);
    }

    /**
     * Search user
     *
     * @param Request $request
     *
     * @return json
     */
    public function search(Request $request)
    {
        $select = ['id','name', 'email'];
        $conditions = $request->all();
        $user = $this->userRepository->findByConditions($conditions, $select);
        return $this->responseSuccess(['results' => $user->all()]);
    }

    /**
     * Get user's data
     *
     * @param Request $request
     *
     * @return json
     */
    public function show(Request $request)
    {
        try {
            $select = ['id','name', 'email'];
            $user = $this->userRepository->find($request->id, $select);
            return $this->responseSuccess(['user' => $user]);
        } catch (\Exception $e) {
            report($e);
        }
        return $this->responseError("Can not find user", 500);
    }

    /**
     * Update user
     *
     * @param UserUpdatedRequest $request
     *
     * @return json
     */
    public function update(UserUpdatedRequest $request)
    {
        try {
            $data = $request->all();
            $data['id'] = $request->id;
            $result = app(CommandFactory::class)->handle(UserUpdateCommand::class, $data);
            if ($result) {
                return $this->responseSuccess(['message' => 'Updated Successfully']);
            }
        } catch (\Exception $e) {
            report($e);
        }
        return $this->responseError("Can not update user", 500);
    }

    public function createUsers(Request $request)
    {
        logger(__METHOD__);
        CreateBatchUsersJob::dispatch($request['batch']);
        logger('===> FINISHED CREATE USERS');
    }
}
