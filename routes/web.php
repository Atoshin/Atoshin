<?php

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

Route::get('/', function () {return view('welcome');});
Route::get('admin/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');



Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::resource('admins', \App\Http\Controllers\AdminController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);
Route::resource('artists', \App\Http\Controllers\ArtistController::class);
Route::resource('galleries', \App\Http\Controllers\GalleryController::class);
