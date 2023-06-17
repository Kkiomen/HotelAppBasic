<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;

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

//Route::view('/', \App\Http\Livewire\IndexPage::class)->name('index');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/doc', [\App\Http\Controllers\DocumentationController::class, 'documentation'])->name('documentation');
Route::get('/doc/save-product', [\App\Http\Controllers\DocumentationController::class, 'documentationSave'])->name('documentationSave');
Route::get('/doc/send-description', [\App\Http\Controllers\DocumentationController::class, 'documentationSend'])->name('documentationSend');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::get('test2', [\App\Http\Controllers\TestController::class, 'test2'])
    ->name('test');
Route::get('test3', [\App\Http\Controllers\TestController::class, 'test3'])
    ->name('test3');

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
