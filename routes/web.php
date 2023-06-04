<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LandingPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingPage::class, 'index'])->name('landing.view');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth:web')->group(function () {
    Route::controller(ArticlesController::class)->group(function () {
        Route::get('/articles', 'index')->name('view.articles');
        Route::get('/form/article/add', 'create')->name('create.articles');
        Route::post('/add/article', 'store')->name('store.articles');
        Route::get('/edit/{articles}/articles', 'edit')->name('edit.articles');
        Route::put('/update/{articles}/articles', 'update');
        Route::delete('/delete/{articles}/articles', 'destroy');
    });
    Route::controller(CategoriesController::class)->group(function () {
        Route::get('/category', 'index')->name('view.categories');
        Route::get('/form/categories/add', 'create')->name('create.categories');
        Route::post('/add/categories', 'store')->name('store.categories');
        Route::get('/edit/{categories}/categories', 'edit')->name('edit.categories');
        Route::put('/update/{categories}/categories', 'update');
        Route::delete('/delete/{categories}/categories', 'destroy');
    });
});
