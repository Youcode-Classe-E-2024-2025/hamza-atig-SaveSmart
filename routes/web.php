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
})->middleware('guest');

Route::get('/signup', function () {
    return view('signup');
})->middleware('guest');

Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

Route::get('/dash', function () {
    return view('dash');
})->name('dash')->middleware('VerifyLoggedProfile');

Route::get('/goals', function () {
    return view('goals');
})->name('goals')->middleware('VerifyLoggedProfile', 'auth');

Route::get('/save', function () {
    return view('save');
})->name('save')->middleware('VerifyLoggedProfile', 'auth');

Route::post('/signup', [App\Http\Controllers\AuthController::class, 'store'])->name('signup');

Route::get('/logout-profile', [App\Http\Controllers\ProfileController::class, 'destroy']);

Route::get('/deleteprofile/{profile}', [App\Http\Controllers\ProfileController::class, 'delete'])->name('deleteprofile');

Route::post('/ispofile/{profile}', [App\Http\Controllers\ProfileController::class, 'checkPassword']);

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'destroy'])->name('logout');

Route::post('/createprofile', [App\Http\Controllers\ProfileController::class, 'store'])->name('createprofile');

Route::post('/addgoal', [App\Http\Controllers\GoalController::class, 'store'])->name('addgoal');

Route::get('/home', [App\Http\Controllers\AuthController::class, 'index'])->name('home');

Route::get('/pdf', [App\Http\Controllers\HistoryController::class, 'pdf'])->name('pdf');

Route::get('/excel', [App\Http\Controllers\HistoryController::class, 'excel'])->name('excel');

Route::get('/deletegoal/{goal}', [App\Http\Controllers\GoalController::class, 'destroy'])->name('deletegoal')->middleware('auth', 'VerifyLoggedProfile');

Route::get('/bet/{goal}', [App\Http\Controllers\GoalController::class, 'bet'])->name('bet')->middleware('auth', 'VerifyLoggedProfile');

Route::post('/transaction', [App\Http\Controllers\HistoryController::class, 'store'])->name('transaction');

Route::post('/updateIncome', [App\Http\Controllers\BalenceController::class, 'update'])->name('updateIncome');

Route::delete('/balance/{balence}', [App\Http\Controllers\BalenceController::class, 'destroy'])->name('balance.destroy');

// Route::get('/profile/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('show');
