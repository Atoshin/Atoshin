<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {

    //region home page

    Route::get('homepage/material',[\App\Http\Controllers\Api\HomePageController::class,'gethomePageMaterial'])->name('homepage');
    Route::post('assets/{type}/{asset_id}/media/upload', [\App\Http\Controllers\Api\MediaController::class, 'upload']);


});
