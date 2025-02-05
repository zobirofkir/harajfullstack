<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FirebaseAuthRequest;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Models\User;
use App\Services\Facades\FirebaseAuthFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FirebaseAuthController extends Controller
{
    public function login(FirebaseAuthRequest $request)
    {
        return FirebaseAuthFacade::login($request);
    }
}
