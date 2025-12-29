<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\v1\CategoryController;
use Modules\Admin\Http\Controllers\v1\GalleryController;

Route::prefix('admin')->group(function () {
//Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::apiResource('admins', AdminController::class)->names('admin');
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('galleries', GalleryController::class);
});
