<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\Category;
use App\Models\User;
use App\Observers\CarObserver;
use App\Observers\CategoryObserver;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Category::observe(CategoryObserver::class);
        Car::observe(CarObserver::class);
    }
}
