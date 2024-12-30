<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class ContactSellerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ContactSellerService';
    }
}
