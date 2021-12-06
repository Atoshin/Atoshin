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

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');


Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::resource('admins', \App\Http\Controllers\AdminController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);
Route::resource('artists', \App\Http\Controllers\ArtistController::class);

//region galleries
Route::resource('galleries', \App\Http\Controllers\GalleryController::class);
Route::get('locations/{gallery_id}/create', [\App\Http\Controllers\LocationController::class, 'create'])->name('locations.create');
Route::post('locations/{gallery_id}/store', [\App\Http\Controllers\LocationController::class, 'store'])->name('locations.store');
//end

//region media
Route::post('upload/{mediable_type}/{mediable_id}', [ \App\Http\Controllers\MediaController::class, 'uploadFile' ])->name('uploadFile');
Route::get('media/upload/page/{type}/{id}',[\App\Http\Controllers\MediaController::class,'uploadPage'])->name('upload.page');
//end

//region assets
Route::resource('assets', \App\Http\Controllers\AssetController::class);
//end

//region videos
Route::get('videos/{asset_id}',[\App\Http\Controllers\VideoController::class,'index'])->name('videos.index');
Route::get('videos/{asset_id}/create',[\App\Http\Controllers\VideoController::class,'create'])->name('videos.create');
Route::patch('videos/{asset_id}/update',[\App\Http\Controllers\VideoController::class,'update'])->name('videos.update');
Route::delete('videos/{asset_id}/destroy',[\App\Http\Controllers\VideoController::class,'destroy'])->name('videos.destroy');
Route::get('videos/{asset_id}/edit',[\App\Http\Controllers\VideoController::class,'edit'])->name('videos.edit');
Route::post('videos/{asset_id}/store',[\App\Http\Controllers\VideoController::class,'store'])->name('videos.store');
//end

//contracts region
Route::get('contracts/{asset_id}',[\App\Http\Controllers\ContractController::class,'index'])->name('contracts.index');
Route::get('contracts/{asset_id}/create',[\App\Http\Controllers\ContractController::class,'create'])->name('contracts.create');
Route::delete('contracts/{id}/destroy',[\App\Http\Controllers\ContractController::class,'destroy'])->name('contracts.destroy');
Route::post('contracts/store',[\App\Http\Controllers\ContractController::class,'store'])->name('contracts.store');
//end

//redirect region
Route::get('redirect/{route}',function ($route) {
    return redirect()->route($route);
})->name('redirect');

Route::get('redirect/{route}/{arguments}',function ($route,$arguments) {
    return redirect()->route($route,$arguments);
})->name('redirect.with.arguments');
