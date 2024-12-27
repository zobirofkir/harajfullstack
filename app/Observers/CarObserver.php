<?php

namespace App\Observers;

use App\Models\Car;
use Illuminate\Support\Str;

class CarObserver
{
    /**
     * Handle the Car "creating" event.
     */
    public function creating(Car $car): void
    {
        $slug = Str::slug($car->title);
        $existingCar = Car::where('slug', 'like', "$slug%")->orderBy('slug', 'desc')->first();

        $car->slug = $existingCar ? "{$slug}-" . ((int) last(explode('-', $existingCar->slug)) + 1) : $slug;
    }

    /**
     * Handle the Car "updating" event.
     */
    public function updating(Car $car): void
    {
        if ($car->isDirty('title')) {
            $slug = Str::slug($car->title);
            $existingCar = Car::where('slug', 'like', "$slug%")->orderBy('slug', 'desc')->first();

            $car->slug = $existingCar ? "{$slug}-" . ((int) last(explode('-', $existingCar->slug)) + 1) : $slug;
        }
    }

}
