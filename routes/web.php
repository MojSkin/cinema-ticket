<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'welcome'])->name('home');

Route::get('/movies', [App\Http\Controllers\HomeController::class, 'movies'])->name('movies');
Route::get('/movies/{id}', [App\Http\Controllers\HomeController::class, 'movie_detail'])->name('movie-detail');

Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');

    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
});

Route::middleware('auth')->group(function (){
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});
