<?php

namespace App\Providers;

use App\Services\Services\FirebaseAuthService;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Auth as FirebaseAuth;

class FirebaseAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('FirebaseAuthService', function ($app) {
            $firebaseAuth = $app->make(FirebaseAuth::class);

            return new FirebaseAuthService($firebaseAuth);
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
