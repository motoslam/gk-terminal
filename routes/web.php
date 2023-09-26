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

    Route::get('/user', function (Request $request) {
        return auth()->check() ? $request->user() : response()->json(['message' => 'Unauthorized.'], 401);
    });

    Route::middleware('admin')->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/register', [RegisterController::class, 'register'])->name('users.register');
    });

    Route::prefix('license')->group(function () {
        Route::get('/', [LicenseController::class, 'show'])->name('license.show');
        Route::post('/create', [LicenseController::class, 'create'])->name('license.create');
    });

    Route::get('/companies', [CompanyController::class, 'index']);
});

# Роутинг осуществляется React приложением
Route::get('/{path?}', [ReactController::class, 'show'])
    ->where(['path' => '.*']);
