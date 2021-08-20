<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use App\Facades\UserRepository;
use CommonUsage;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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
        $user = UserRepository::findByEmail($request->email);

        if ($user && CommonUsage::checkHashedPassword($request->password, $user->password)) {
            return $this->responseSuccess(['api_token' => $user->api_token]);
        }
        return $this->responseError('Login Failed', 401);
    }
}
