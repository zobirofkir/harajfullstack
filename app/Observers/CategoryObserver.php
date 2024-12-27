<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "creating" event.
     */
    public function creating(Category $category): void
    {
        $slug = Str::slug($category->title);
        $existingCategory = Category::where('slug', 'like', "$slug%")->orderBy('slug', 'desc')->first();

        $category->slug = $existingCategory ? "{$slug}-" . ((int) last(explode('-', $existingCategory->slug)) + 1) : $slug;
    }

    /**
     * Handle the Category "updating" event.
     */
    public function updating(Category $category): void
    {
        if ($category->isDirty('title')) {
            $slug = Str::slug($category->title);
            $existingCategory = Category::where('slug', 'like', "$slug%")->orderBy('slug', 'desc')->first();

            $category->slug = $existingCategory ? "{$slug}-" . ((int) last(explode('-', $existingCategory->slug)) + 1) : $slug;
        }
    }
}
