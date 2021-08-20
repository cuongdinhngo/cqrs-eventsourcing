<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdatedRequest;
use App\CommandHandlers\Handlers\User\UserRegisterCommand;
use App\CommandHandlers\Handlers\User\UserUpdateCommand;
use App\CommandHandlers\Handlers\User\CreateBatchUsersCommand;
use App\Jobs\CreateBatchUsersJob;
use App\Contracts\User as UserContract;
use App\Jobs\ProcessUserJobs;
use App\Models\User;
use App\Facades\CommandFactory;
use App\Facades\UserRepository;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
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
            $result = CommandFactory::handle(UserRegisterCommand::class, $request->all());
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
        $user = UserRepository::findByConditions($conditions, $select);
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
            $user = UserRepository::find($request->id, $select);
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
            $result = CommandFactory::handle(UserUpdateCommand::class, $data);
            if ($result) {
                return $this->responseSuccess(['message' => 'Updated Successfully']);
            }
        } catch (\Exception $e) {
            report($e);
        }
        return $this->responseError("Can not update user", 500);
    }

    /**
     * Create many users
     *
     * @param Request $request
     * @return json
     */
    public function createUsers(Request $request)
    {
        try {
            $data = $request->batch;
            $result = CommandFactory::handle(CreateBatchUsersCommand::class, $data);
            if ($result) {
                return $this->responseSuccess(['message' => 'Successfully Created a batch of users']);
            }
        } catch (\Exception $e) {
            report($e);
        }
        return $this->responseError("Can not create a batch of users", 500);
    }
}
