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

    Route::get('homepage/material', [\App\Http\Controllers\Api\HomePageController::class, 'gethomePageMaterial'])->name('homepage');
    Route::post('assets/{type}/{asset_id}/media/upload', [\App\Http\Controllers\Api\MediaController::class, 'upload']);
    Route::post('wallets/store', [\App\Http\Controllers\Api\WalletController::class, 'storeWallet']);
    Route::get('asset/{id}/show', [\App\Http\Controllers\Api\ShowAssetController::class, 'show']);
    Route::get('user/{address}/show', [\App\Http\Controllers\Api\ProfileController::class, 'show']);
    Route::get('artist/{id}/show', [\App\Http\Controllers\Api\ShowArtistController::class, 'show']);
    Route::get('gallery/{id}/show', [\App\Http\Controllers\Api\ShowGalleryController::class, 'show']);

    Route::get('asset/{asset}/contracts', [\App\Http\Controllers\Api\AssetController::class, 'getContracts']);
    Route::get('contract/{id}/data', [\App\Http\Controllers\Api\AssetController::class, 'getContract']);
    Route::post('contract/{contract}/ipfs-hash', [\App\Http\Controllers\Api\AssetController::class, 'setIpfsHash']);
    Route::post('asset/{asset}/mint-record', [\App\Http\Controllers\Api\AssetController::class, 'setAssetMintRecord']);
    Route::post('contract/{contract}/mint-record', [\App\Http\Controllers\Api\AssetController::class, 'setContractMintRecord']);



    Route::get('marketplace', [\App\Http\Controllers\Api\MarketPlaceController::class, 'getAssets']);
    Route::get('artists', [\App\Http\Controllers\Api\ArtistsListController::class, 'getArtists']);
    Route::get('galleries', [\App\Http\Controllers\Api\GalleriesListController::class, 'getGalleries']);
});


Route::fallback(function () {
    return response()->json([
        'message' => 'Resource Not Found.'], 404);
});



