<?php

namespace App\Services\Constructors;

use App\Models\Car;

interface CarConstructor
{
    /**
     * Get all cars
     */
    public function index(): array;

    /**
     * Get car by slug
     *
     * @return array
     */
    public function show(string $slug);
}
