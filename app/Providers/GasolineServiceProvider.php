<?php

namespace App\Providers;

use App\Services\Services\GasolineService;
use Illuminate\Support\ServiceProvider;

class GasolineServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('GasolineService', function () {
            return new GasolineService();
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
