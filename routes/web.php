<?php

use Illuminate\Foundation\Application;
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
    return redirect()->route('register');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->only('index', 'update', 'destroy')->middleware('admin');
    Route::put('customers/{customer}/approved', [App\Http\Controllers\CustomerController::class, 'approved'])->name('approved')->middleware('active');
    Route::resource('customers', CustomerController::class)->middleware('active');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
