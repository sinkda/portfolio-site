<?php

use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

#region Web Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [MessageController::class, 'index'])->name('message.index');
Route::post('/contact', [MessageController::class, 'store'])->name('message.store');
#endregion

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
Route::middleware(['auth'])->prefix('dashboard')->name('admin.')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    /*
    |--------------------------------------------------------------------------
    | Admin Message Routes
    |--------------------------------------------------------------------------
    */

    #region Admin Message Routes
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show')
        ->missing(fn() => redirect()->route('admin.messages.index')->with('missing', true));
    #endregion

    /*
    |--------------------------------------------------------------------------
    | Admin Project Routes
    |--------------------------------------------------------------------------
    */

    #region Admin Project Routes
    Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [AdminProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/create', [AdminProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/update/{project:slug}', [AdminProjectController::class, 'edit'])->name('projects.edit')
            ->missing(fn() => redirect()->route('admin.projects.index')->with('missing', true));;
    Route::put('/projects/update', [AdminProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/delete/{project:slug}', [AdminProjectController::class, 'delete'])->name('projects.delete');
    #endregion
});
#endregion
