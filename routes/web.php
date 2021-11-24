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
Route::prefix('admin')->group(function(){
    Route::get('admins/index',[\App\Http\Controllers\AdminController::class,'index'])->name('admin.index');
    Route::get('admins/create',[\App\Http\Controllers\AdminController::class,'create'])->name('admin.create');
    Route::post('admins/store',[\App\Http\Controllers\AdminController::class,'store'])->name('admin.store');
    Route::get('admins/{admin_id}/edit',[\App\Http\Controllers\AdminController::class,'edit'])->name('admin.edit');
    Route::patch('admins/{admin_id}/update',[\App\Http\Controllers\AdminController::class,'update'])->name('admin.update');
    Route::delete('admins/{admin_id}/delete',[\App\Http\Controllers\AdminController::class,'destroy'])->name('admin.destroy');
//user
    Route::get('users/index',[\App\Http\Controllers\UserController::class,'index'])->name('user.index');






});
