<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FirebaseAuthController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'idToken' => 'required|string',
        ]);

        try {
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($data['idToken']);
            $firebaseUid = $verifiedIdToken->claims()->get('sub');

            $firebaseUser = $this->firebaseAuth->getUser($firebaseUid);

            $user = User::firstOrCreate(
                ['email' => $firebaseUser->email],
                [
                    'username' => $firebaseUser->displayName ?? $firebaseUser->email,
                    'name'     => $firebaseUser->displayName ?? $firebaseUser->email,
                    'password' => Hash::make(uniqid()),
                ]
            );

            Auth::login($user);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }
    }
}
