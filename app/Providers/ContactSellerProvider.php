<?php

namespace App\Providers;

use App\Services\Services\ContactSellerService;
use Illuminate\Support\ServiceProvider;

class ContactSellerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('ContactSellerService', function () {
            return new ContactSellerService;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
