<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class UpdateProfileFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UpdateProfileService';
    }
}
