<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class FirebaseAuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'FirebaseAuthService';
    }
}
