<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

//Category Routes
Route::controller(CategoryController::class)->prefix('category')->as('category.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{category}', 'edit')->name('edit');
    Route::put('/update', 'update')->name('update');
    Route::delete('/delete', 'destroy')->name('destroy');
});

//Blog Routes
Route::controller(BlogController::class)->prefix('blog')->as('blog.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{blog}', 'edit')->name('edit');
    Route::put('/update', 'update')->name('update');
    Route::delete('/delete', 'destroy')->name('destroy');
});
