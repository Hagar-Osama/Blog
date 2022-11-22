<?php

use App\Http\Controllers\ArticalController;
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

//Artical Routes
Route::controller(ArticalController::class)->prefix('artical')->as('artical.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{artical}', 'edit')->name('edit');
    Route::put('/update', 'update')->name('update');
    Route::delete('/delete', 'destroy')->name('destroy');
});
