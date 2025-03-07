<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactSellerController;
use App\Http\Controllers\FirebaseAuthController;
use App\Http\Controllers\GasolineController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UpdateProfileController;
use App\Services\Services\PaymentService;
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
Route::get('/search/cars', [SearchController::class, 'searchByTitle'])->name('search.cars');

/**
 * Show a specific logo
 */
Route::get('/logos/{id}', [LogoController::class, 'show'])->name('logos.show');

/**
 * About page
 */
Route::get('/abouts', function () {
    return view('pages.abouts.index');
});

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
 * Privacy page
 */
Route::get('/privacy', function () {
    return view('pages.privacy.privacy');
});

/**
 * Store offer
 */
Route::post('offers/{slug}', [OfferController::class, 'store'])->name('offers.store');

/**
 * Get register
 */
Route::get('/register', [AuthController::class, 'index'])->name('index.register');

/**
 * Store register
 */
Route::post('/register', [AuthController::class, 'register'])->name('register');

/**
 * Get login
 */
Route::get('/login', [AuthController::class, 'indexLogin'])->name('index.login');

/**
 * Firebase login
 */
Route::post('/firebase-login', [FirebaseAuthController::class, 'login'])->name('firebase.login');

/**
 * Store login
 */
Route::post('/login', [AuthController::class, 'login'])->name('login');

/**
 * Store logout
 */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * Reset password
 */
Route::get('password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

/**
 * Reset password
 */
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

/**
 * Forgot password
 */
Route::get('forgot-password', [AuthController::class, 'indexForgotPassword'])->name('forgot-password');

/**
 * Forgot password
 */
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

/**
 * Authenticated Routes
 */
Route::middleware('auth')->group(function () {

    /**
     * List of chats
     */
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');

    /**
     * Show a specific chat
     */
    Route::get('/chats/{userName}/{carId}', [ChatController::class, 'show'])->name('chats.show');

    /**
     * Store message
     */
    Route::post('/chats/{chat}/messages', [ChatController::class, 'sendMessage'])->name('chats.send');

    /**
     * Get Active Card
     */
    Route::get('/payments/activate/{user}', [PaymentController::class, 'activate'])->name('moyasar.activate');

    /**
     *Get Profile Form
     */
    Route::get('/profile/form', [UpdateProfileController::class, 'updateProfileForm'])->name('profile.form');

    /**
     * Update Current Authenticated User
     */
    Route::post('/profile/update', [UpdateProfileController::class, 'updateProfile'])->name('profile.update');

    /**
     * Start Chat
     */
    Route::get('/chats/start/{userName}/{carId}', [ChatController::class, 'startChat'])->name('chats.start');

    /**
     * Show verify otp form
     */
    Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('verify.otp');

    /**
     * Verify otp
     */
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

    /**
     * Resend otp
     */
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');


    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');

    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

    Route::get('/payment/success', function () {
        return view('tap_company.success');
    })->name('payment.success');

    Route::get('/payment/callback', [PaymentService::class, 'handleCallback'])->name('payment.callback');
    Route::get('/payment/error', function() {
        return view('tap_company.payment_error');
    })->name('payment.error');

});
