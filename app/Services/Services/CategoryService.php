<?php

namespace App\Services\Services;

use App\Models\Category;
use App\Models\Car;
use App\Services\Constructors\CategoryConstructor;

class CategoryService implements CategoryConstructor
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return [
            'categories' => $categories
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return array
     */
    public function show(string $slug): array
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return [
                'categories' => null,
                'cars' => [],
            ];
        }

        $cars = Car::where('category_id', $category->id)->get();

        return [
            'categories' => $category,
            'cars' => $cars,
        ];
    }
}
