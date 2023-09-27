<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LicenseController;
use App\Mail\RegisterMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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

Route::post('/signin', [LoginController::class, 'authenticate']);

Route::middleware('auth:sanctum')->prefix('spa')->group(function () {

    # Текущий пользователь
    Route::get('/user', function (Request $request) {
        return auth()->check() ? $request->user() : response()->json(['message' => 'Unauthorized.'], 401);
    });

    # Пользователи
    Route::middleware('admin')->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::post('/register', [RegisterController::class, 'register'])->name('users.register');
        Route::post('/{user}/block', [UserController::class, 'block'])->name('users.block');
        Route::post('/{user}/unblock', [UserController::class, 'unblock'])->name('users.unblock');
    });

    # Компании (контрагенты)
    Route::middleware('admin')->prefix('companies')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
        Route::post('/attach', [CompanyController::class, 'attach'])->name('companies.attach');
        Route::post('/detach', [CompanyController::class, 'detach'])->name('companies.detach');
        Route::post('/{company}/block', [CompanyController::class, 'block'])->name('companies.block');
        Route::post('/{company}/unblock', [CompanyController::class, 'unblock'])->name('companies.unblock');
        Route::delete('/{company}/delete', [CompanyController::class, 'destroy'])->name('companies.delete');
    });

    # Лицензия
    Route::prefix('license')->group(function () {
        Route::get('/', [LicenseController::class, 'show'])->name('license.show');
        Route::post('/create', [LicenseController::class, 'create'])->name('license.create');
    });

});

# Роутинг осуществляется React приложением
Route::get('/{path?}', [ReactController::class, 'show'])
    ->where(['path' => '.*']);
