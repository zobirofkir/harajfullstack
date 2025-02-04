<?php

namespace App\Services\Services;

use App\Models\Car;
use App\Services\Constructors\CarConstructor;

class CarService implements CarConstructor
{
    /**
     * Get all cars
     */
    public function index(): array
    {
        $cars = Car::orderBy('created_at', 'desc')->paginate(10);

        return [
            'cars' => $cars,
        ];
    }

    /**
     * Get single car
     *
     * @param  Car  $car
     * @return array
     */
    public function show(string $slug)
    {
        $car = Car::where('slug', $slug)->first();

        return $car;
    }
}
