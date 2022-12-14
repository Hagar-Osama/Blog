<?php

use App\Http\Controllers\Api\ArticalController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    //Users Routes
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{user}/{role}', 'update');
        Route::delete('/{user}', 'destroy');
    });
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/articals', ArticalController::class);

});
