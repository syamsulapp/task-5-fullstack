<?php

use App\Http\Controllers\api\Articles;
use App\Http\Controllers\api\Auth;
use App\Http\Controllers\api\Categories;
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

        Route::prefix('articles')->group(function () {
            Route::get('', [Articles::class, 'index'])->name('view.articles');
            Route::post('', [Articles::class, 'store'])->name('store.articles');
            Route::get('{id}/detail', [Articles::class, 'detail'])->name('detail.articles');
            Route::put('{id}/update', [Articles::class, 'update'])->name('update.articles');
            Route::delete('{id}/delete', [Articles::class, 'delete'])->name('delete.articles');
        });
        Route::prefix('categories')->group(function () {
            Route::get('', [Categories::class, 'index'])->name('view.categories');
            Route::post('', [Categories::class, 'store'])->name('store.categories');
            Route::get('{id}/detail', [Categories::class, 'detail'])->name('detail.categories');
            Route::put('{id}/update', [Categories::class, 'update'])->name('update.categories');
            Route::delete('{id}/delete', [Categories::class, 'delete'])->name('delete.categories');
        });
    });
});
