<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [MessageController::class, 'index'])->name('message.index');
Route::post('/contact', [MessageController::class, 'store'])->name('message.store');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

#region Auth Routes
Route::get('/login', [AuthController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.action')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
#endregion

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

#region Admin Routes

#endregion
