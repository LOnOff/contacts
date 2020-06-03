<?php

namespace App\Http\Controllers\api_v1\AuthControllers;
use App\Http\Controllers\api_v1\BaseApiController as BaseApiController;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\SignUpUserRequest;
use App\Http\Requests\Auth\LoginUserRequest;

use App\Services\api\UserAuthService;
use Exception;


class AuthController extends BaseApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function signUp(SignUpUserRequest $request)
    {
        try {
            return app(UserAuthService::class)->signUpUser($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function login(LoginUserRequest $request)
    {
        try {
            return app(UserAuthService::class)->loginUser($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function logout(Request $request)
    {
        try {
            return app(UserAuthService::class)->logoutUser($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
