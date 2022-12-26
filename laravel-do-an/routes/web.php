<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::prefix('user')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::get('{id}', [UserController::class, 'show'])->name('user.show')->where(['id' => '[0-9]+'])->middleware('permission');
        Route::get('me', [UserController::class, 'me'])->name('user.me');
        Route::post('', [UserController::class, 'store'])->name('user.store');
        Route::post('{id}/update', [UserController::class, 'update'])->name('user.update')->where(['id' => '[0-9]+']);
        Route::post('{id}/update-avatar', [UserController::class, 'updateAvatar'])->name('user.update-avatar')->where(['id' => '[0-9]+']);
        Route::post('action', [UserController::class, 'action'])->name('user.action');
        Route::get('{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy')->where(['id' => '[0-9]+'])->middleware('permission');
    });

    Route::prefix('admin')->group(function () {
        Route::middleware('permission')->group(function () {
            Route::view('/', 'admin');
            Route::prefix('user')->group(function () {
                Route::get('', [AdminUserController::class, 'index'])->name('admin.user.index');
                Route::get('{id}', [AdminUserController::class, 'show'])->name('admin.user.show')->where(['id' => '[0-9]+']);
                Route::post('', [AdminUserController::class, 'store'])->name('admin.user.store');
                Route::post('{id}/update', [AdminUserController::class, 'update'])->name('admin.user.update')->where(['id' => '[0-9]+']);
                Route::post('action', [AdminUserController::class, 'action'])->name('admin.user.action');
            });
        });
    });
});
