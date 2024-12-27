<?php

namespace App\Http\Controllers;

use App\Services\Facades\CategoryFacade;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryFacade::index()['categories'];
        return view('pages.categories.index', compact('categories'));
    }

    public function show(string $slug)
    {
        $response = CategoryFacade::show($slug);

        $category = $response['categories'];
        $cars = $response['cars'];

        if (!$category) {
            abort(404, 'Category not found.');
        }

        return view('pages.categories.show', compact('category', 'cars'));
    }
}
