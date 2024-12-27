<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/**
 * Home page
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * List of categories
 */
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

/**
 * Show a specific category
 */
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('categories.show');

/**
 * List of cars
 */
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

/**
 * Show a specific car
 */
Route::get('/car/{car}', [CarController::class, 'show'])->name('cars.show');
