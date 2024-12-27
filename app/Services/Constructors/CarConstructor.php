<?php
namespace App\Services\Constructors;

use App\Models\Car;

interface CarConstructor
{
    /**
     * Get all cars
     *
     * @return array
     */
    public function index() : array;

    /**
     * Get car by slug
     *
     * @param Car $car
     * @return array
     */
    public function show(Car $car) : array;
}
