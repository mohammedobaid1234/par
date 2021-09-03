<?php

use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\VideosController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('admin', [HomeController::class, 'index'])->name('home.index');
Route::resource('admin/reports', ReportsController::class);
Route::resource('admin/videos', VideosController::class);
Route::resource('admin/articles', ArticlesController::class);
require __DIR__.'/auth.php';
