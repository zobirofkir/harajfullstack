<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class LogoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LogoService';
    }
}
