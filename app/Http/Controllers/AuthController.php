<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.register');
    }
    
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        return view('pages.auth.register');
    }

    public function login()
    {
        return view('pages.auth.login');
    }
}
