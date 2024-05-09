<?php

use App\Http\Controllers\Admin\BasketController as AdminBasketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\FrameController as AdminFrameController;
use App\Http\Controllers\Admin\LensController as AdminLensController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\LensController;
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

Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    //Admin resources
    Route::prefix("admin")->group(function () {
        Route::resource("frames", AdminFrameController::class);
        Route::resource("lenses", AdminLensController::class);
        Route::resource("basket", AdminBasketController::class);
        Route::resource("users", UserController::class);
        Route::resource("roles", RoleController::class);
        Route::resource("permissions", PermissionController::class);
    });


    // resources
    Route::get("frames", [FrameController::class, 'index']);
    Route::get("lenses", [LensController::class, 'index']);
    Route::get("baskets",  [BasketController::class, 'index']);
    Route::post("baskets",  [BasketController::class, 'store']);

    // auth management
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
