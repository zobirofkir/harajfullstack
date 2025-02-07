<?php
namespace App\Services\Services;

use App\Services\Constructors\FirebaseAuthConstructor;
use App\Http\Requests\FirebaseAuthRequest;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class FirebaseAuthService implements FirebaseAuthConstructor
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function login(FirebaseAuthRequest $request)
    {
        $data = $request->validated();

        try {
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($data['idToken']);
            $firebaseUid = $verifiedIdToken->claims()->get('sub');

            $firebaseUser = $this->firebaseAuth->getUser($firebaseUid);

            $username = $firebaseUser->displayName ?? $firebaseUser->email;
            $name = $firebaseUser->displayName ?? $firebaseUser->email;
            $email = $firebaseUser->email;

            $originalUsername = $username;
            while (User::where('username', $username)->exists()) {
                $username = $originalUsername . rand(100, 999);
            }

            $originalName = $name;
            while (User::where('name', $name)->exists()) {
                $name = $originalName . rand(100, 999);
            }

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'username' => $username,
                    'name'     => $name,
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

