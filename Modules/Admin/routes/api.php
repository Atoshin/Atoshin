<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\v1\CategoryController;
use Modules\Admin\Http\Controllers\v1\GalleryController;
use Modules\Admin\Http\Controllers\v1\NewsletterController;
use Modules\Admin\Http\Controllers\v1\PermissionController;
use Modules\Admin\Http\Controllers\v1\RoleController;
use Modules\Admin\Http\Controllers\v1\UserController;

Route::prefix('admin')->group(function () {
//Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::apiResource('admins', AdminController::class)->names('admin');
    Route::apiResource('users', UserController::class)->names('user');
    Route::apiResource('newsletters', NewsletterController::class)
        ->only(['index', 'store', 'destroy'])
        ->names('newsletter');

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('galleries', GalleryController::class);
    Route::apiResource('admins', AdminController::class);
    Route::apiResource('roles', RoleController::class);
    Route::post('roles/{role}/sync-permissions', [RoleController::class, 'syncPermissions']);

    Route::apiResource('permissions', PermissionController::class);

});
