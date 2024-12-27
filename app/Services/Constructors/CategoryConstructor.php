<?php
namespace App\Services\Constructors;

use App\Models\Category;

interface CategoryConstructor
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index() : array;

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return array
     */
    public function show(Category $category) : array;
}

