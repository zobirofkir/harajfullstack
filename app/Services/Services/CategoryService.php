<?php
namespace App\Services\Services;

use App\Models\Category;
use App\Services\Constructors\CategoryConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService implements CategoryConstructor
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $categories = Category::all();
        return [
            'categories' => $categories
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return array
     */
    public function show(Category $category): array
    {
        $category = Category::find($category->slug);
        return [
            'category' => $category
        ];
    }
}
