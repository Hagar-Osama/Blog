<?php

use App\Http\Controllers\ArticalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//register & login routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'registerPage')->name('registerPage');
    Route::get('/login', 'loginPage')->name('loginPage');
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class,'logout'])->name('logout');
    Route::view('/', 'dashboard')->name('dashboard');
    //Users Routes
    Route::controller(UserController::class)->prefix('user')->as('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{user}', 'edit')->name('edit');
        Route::put('/update/{role}', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });
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
});
