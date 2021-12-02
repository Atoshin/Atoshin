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
Route::resource('contracts', \App\Http\Controllers\ContractController::class);
Route::resource('galleries', \App\Http\Controllers\GalleryController::class);
Route::resource('assets', \App\Http\Controllers\AssetController::class);
Route::get('videos/{asset_id}',[\App\Http\Controllers\VideoController::class,'index'])->name('videos.index');
Route::get('videos/{asset_id}/create',[\App\Http\Controllers\VideoController::class,'create'])->name('videos.create');
Route::patch('videos/{asset_id}/update',[\App\Http\Controllers\VideoController::class,'update'])->name('videos.update');
Route::delete('videos/{asset_id}/destroy',[\App\Http\Controllers\VideoController::class,'destroy'])->name('videos.destroy');
Route::get('videos/{asset_id}/edit',[\App\Http\Controllers\VideoController::class,'edit'])->name('videos.edit');
Route::post('videos/{asset_id}/store',[\App\Http\Controllers\VideoController::class,'store'])->name('videos.store');
Route::post('upload', [ \App\Http\Controllers\ContractController::class, 'uploadFile' ])->name('uploadFile');

