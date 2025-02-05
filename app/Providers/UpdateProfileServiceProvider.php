<?php

namespace App\Providers;

use App\Services\Services\UpdateProfileService;
use Illuminate\Support\ServiceProvider;

class UpdateProfileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('UpdateProfileService', function () {
            return new UpdateProfileService();
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
