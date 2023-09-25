<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Str;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/register', [RegisterController::class, 'register']);
});

# Роутинг осуществляется React приложением
Route::get('/{path?}', [ReactController::class, 'show'])
    ->where(['path' => '.*']);
