<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class CarFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CarService';
    }
}
