<?php
namespace App\Services\Constructors;

use App\Http\Requests\FirebaseAuthRequest;

interface FirebaseAuthConstructor
{
    public function login(FirebaseAuthRequest $request);
}
