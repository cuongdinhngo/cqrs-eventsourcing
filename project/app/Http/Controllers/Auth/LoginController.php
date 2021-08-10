<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\User\CommandHandlers\UserCommon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public $userRepository;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('guest')->except('logout');
        $this->userRepository = $userRepository;
    }

    /**
     * Login
     *
     * @param LoginRequest $request
     *
     * @return json
     */
    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->findByEmail($request->email);
        if (app(UserCommon::class)->checkPassword($request->password, $user->password)) {
            return $this->responseSuccess(['api_token' => $user->api_token]);
        }
        return $this->responseError('Login Failed', 401);
    }
}
