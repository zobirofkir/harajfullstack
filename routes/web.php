<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactSellerController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\SearchController;
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

/**
 * Search cars
 */
Route::get('/search/cars', [SearchController::class, 'searchByTitle']);

/**
 * Show a specific logo
 */
Route::get('/logos/{id}', [LogoController::class, 'show'])->name('logos.show');


/**
 * About page
 */
Route::get('/abouts', function () {return view('pages.abouts.index');});

/**
 * Contact page
 */
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

/**
 * Store contact
 */
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

/**
 * Store contact
 */
Route::post('/contact-seller', [ContactSellerController::class, 'store'])->name('contact.seller');
