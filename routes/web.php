<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::post('/signup', [App\Http\Controllers\AuthController::class, 'store'])->name('signup');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'destroy'])->name('logout');

Route::get('/home', [App\Http\Controllers\AuthController::class, 'index'])->name('home');

// Route::get('/profile/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('show');
