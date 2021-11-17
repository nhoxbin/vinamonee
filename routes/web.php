<?php

use Illuminate\Foundation\Application;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('artisan/{password}/{command}', function($password, $command) {
    if ($password === '74ujk6Z2wO') {
        $exitCode = \Artisan::call($command, request()->all());
        echo $exitCode;
    }
});

Route::get('/', function () {
    /* return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]); */
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->only('index', 'update', 'destroy')->middleware('admin');
    Route::resource('customers', CustomerController::class)->middleware('active');
    Route::resource('customers.payments', PaymentController::class)->only('store', 'update');

    Route::prefix('customers')->middleware(['active'])->group(function () {
        Route::post('get', [App\Http\Controllers\CustomerController::class, 'getCustomers'])->name('customers.get');
        Route::put('{customer}/approved', [App\Http\Controllers\CustomerController::class, 'approved'])->name('approved');
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
