<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/**
 * List of categories
 */
Route::get('/', [CategoryController::class, 'index'])->name('categories.index');

/**
 * Show a specific category
 */
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('categories.show');
