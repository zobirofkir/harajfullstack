<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class GasolineFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'GasolineService';
    }
}
