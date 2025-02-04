<?php

namespace App\Services\Constructors;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

interface AuthConstructor
{
    public function index();

    public function register(RegisterRequest $request);

    public function indexLogin();

    public function login(LoginRequest $request);

    public function logout(Request $request);

    public function indexForgotPassword();

    public function forgotPassword(Request $request);

    public function showResetPasswordForm($token);

    public function resetPassword(Request $request);

    public function updateProfileForm();

    public function updateProfile(UpdateProfileRequest $request);
}
