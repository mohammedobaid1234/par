<?php

use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\CouncilsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\VideosController;
use App\Http\Controllers\Admin\NewspaperController;
use App\Http\Controllers\Admin\UsersController;
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
Route::resource('admin/newspapers', NewspaperController::class);

Route::get('/admin/users/create/{id}', [UsersController::class, 'create'])->name('users.create');
Route::get('/admin/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/admin/users/before-create', [UsersController::class, 'beforeCreate'])->name('users.beforeCreate');
Route::post('/admin/users', [UsersController::class, 'store'])->name('users.store');
Route::get('/admin/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
Route::put('/admin/users/{id}', [UsersController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

Route::get('/admin/councils', [CouncilsController::class, 'index'])->name('councils.index');
Route::get('/admin/councils/create', [CouncilsController::class, 'create'])->name('councils.create');
Route::post('/admin/councils', [CouncilsController::class, 'store'])->name('councils.store');
Route::get('/admin/councils/edit/{id}', [CouncilsController::class, 'edit'])->name('councils.edit');
Route::put('/admin/councils/{id}', [CouncilsController::class, 'update'])->name('councils.update');
Route::delete('/admin/councils/{id}', [CouncilsController::class, 'destroy'])->name('councils.destroy');

Route::get('/admin/circles/create', [CouncilsController::class, 'createCircle'])->name('circles.create');
require __DIR__.'/auth.php';
