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
use Modules\Admin\Http\Controllers\RoleController;
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
    Route::get('/', [AdminController::class, 'index'])->name('admin/dashboard');

    Route::post('logout', [AuthenticatedSessionController::class, 'logout'])
        ->name('admin/logout');

    Route::get('users', [UserController::class, 'index'])->name('admin/users/index');
    Route::post('users', [UserController::class, 'store'])->name('admin/users/store');
    Route::get('users/create', [UserController::class, 'create'])->name('admin/users/create');
    Route::get('users-data', [UserController::class, 'indexData'])->name('admin/users/indexData');
    Route::get('users/{user}', [UserController::class, 'edit'])->name('admin/users/edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin/users/update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin/users/destroy');

    Route::get('roles', [RoleController::class, 'index'])->name('admin/roles/index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('admin/roles/create');
    Route::post('roles', [RoleController::class, 'store'])->name('admin/roles/store');
    Route::get('roles/search', [RoleController::class, 'search'])->name('admin/roles/search');
    Route::get('roles-data', [RoleController::class, 'indexData'])->name('admin/roles/indexData');
    Route::get('roles/{role}', [RoleController::class, 'edit'])->name('admin/roles/edit');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('admin/roles/update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('admin/roles/destroy');
});
