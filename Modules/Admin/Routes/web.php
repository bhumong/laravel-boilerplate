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

use Modules\Admin\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('guest.admin')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'loginPage'])->name('admin/login');
    Route::post('/login', [AuthenticatedSessionController::class, 'doLogin'])->name('admin/doLogin');
});



Route::middleware('auth.admin')->group(function () {
    Route::get('/', function () {
        return view('admin::dashboard');
    })->name('admin/dashboard');

    Route::post('logout', [AuthenticatedSessionController::class, 'logout'])
        ->name('admin/logout');
});
