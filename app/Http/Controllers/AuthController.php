<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Facades\AuthFacade;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return AuthFacade::index();
    }

    public function register(RegisterRequest $request)
    {
        return AuthFacade::register($request);
    }

    public function indexLogin()
    {
        return AuthFacade::indexLogin();
    }

    public function login(LoginRequest $request)
    {
        return AuthFacade::login($request);
    }

    public function logout(Request $request)
    {
        return AuthFacade::logout($request);
    }

    public function indexForgotPassword()
    {
        return AuthFacade::indexForgotPassword();
    }

    public function forgotPassword(Request $request)
    {
        return AuthFacade::forgotPassword($request);
    }

    public function showResetPasswordForm($token)
    {
        return AuthFacade::showResetPasswordForm($token);
    }

    public function resetPassword(Request $request)
    {
        return AuthFacade::resetPassword($request);
    }
}
