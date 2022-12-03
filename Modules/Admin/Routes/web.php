<?php

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

use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\Auth\AuthenticatedSessionController;
use Modules\Admin\Http\Controllers\Auth\RegisteredUserController;
use Modules\Admin\Http\Controllers\UserController;

Route::middleware('guest.admin')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'loginPage'])->name('admin/login');
    Route::post('login', [AuthenticatedSessionController::class, 'login'])->name('admin/doLogin');

    Route::get('register', [RegisteredUserController::class, 'registerPage'])
        ->name('admin/register');

    Route::post('register', [RegisteredUserController::class, 'register'])
        ->name('admin/doRegister');
});



Route::middleware('auth.admin')->group(function () {
    Route::get('/', [AdminController::class, 'indexPage'])->name('admin/dashboard');

    Route::post('logout', [AuthenticatedSessionController::class, 'logout'])
        ->name('admin/logout');

    Route::get('users', [UserController::class, 'index'])->name('admin/users/indexPage');
    Route::get('users-data', [UserController::class, 'indexData'])->name('admin/users/index');
});
