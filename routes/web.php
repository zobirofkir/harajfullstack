<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactSellerController;
use App\Http\Controllers\GasolineController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\AuthenticateWithCookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Home page
 */
Route::get('/', function () {
    return view('welcome');
})->name('home');

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

/**
 * List of gasolines
 */
Route::get('/gasolines', [GasolineController::class, 'index'])->name('gasolines.index');

/**
 * Show a specific gasoline
 */
Route::get('/gasoline/{id}', [GasolineController::class, 'show'])->name('gasolines.show');

/**
 * List of chats
 */
Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
Route::get('/chats/{userName}-{carId}', [ChatController::class, 'show'])->name('chats.show');
Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
Route::post('/chats/{chat}/messages', [ChatController::class, 'sendMessage'])->name('chats.send');

/**
 * Privacy page
 */
Route::get('/privacy', function () {return view('pages.privacy.privacy');});

/**
 * Store offer
 */
Route::post('offers/{slug}', [OfferController::class, 'store'])->name('offers.store');

Route::middleware('auth')->group(function () {
    Route::get('/payments/activate/{user}', [PaymentController::class, 'activate'])->name('moyasar.activate');

    Route::get('/update-plan', [PaymentController::class, 'paymentCallback'])->name('payment.callback');
});
