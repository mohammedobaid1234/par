<?php

use App\Http\Controllers\Api\ArticlesController;
use App\Http\Controllers\Api\ReportsController;
use App\Http\Controllers\Api\CouncilsController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\TweetsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\VideosController;
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

Route::apiResource('tweets',TweetsController::class);
Route::apiResource('councils',CouncilsController::class);
Route::apiResource('reports',ReportsController::class);
Route::apiResource('articles',ArticlesController::class);
Route::apiResource('videos',VideosController::class);
Route::apiResource('users',UsersController::class);
Route::apiResource('favorites',FavoritesController::class);
