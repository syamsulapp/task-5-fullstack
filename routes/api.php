<?php

use App\Http\Controllers\api\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'api'], function () {
    Route::post('login', [Auth::class, 'login'])->name('login.api');
    Route::post('register', [Auth::class, 'register'])->name('register.api');

    Route::middleware('session:api')->group(function () {
        Route::post('logout', [Auth::class, 'logout'])->name('logout.api');
        Route::post('user', [Auth::class, 'user'])->name('user.api');
    });
});
