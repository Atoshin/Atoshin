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
    Route::post('wallets/store/signature', [\App\Http\Controllers\Api\WalletController::class, 'storeSignature']);
    Route::post('wallets/store', [\App\Http\Controllers\Api\WalletController::class, 'storeWallet']);
    Route::get('asset/{id}/show', [\App\Http\Controllers\Api\ShowAssetController::class, 'show']);
    Route::get('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', [\App\Http\Controllers\Api\ContractsController::class, 'show']);


    Route::middleware('authorize_metamask')->group(function () {
        Route::get('user/{address}/show', [\App\Http\Controllers\Api\ProfileController::class, 'show']);
        Route::patch('user/{address}/update', [\App\Http\Controllers\Api\ProfileController::class, 'update']);
        //region buy procedure
        Route::post('asset/information/{asset}', [\App\Http\Controllers\Api\AssetController::class, 'info']);
        Route::post('asset/submit-information/{asset}', [\App\Http\Controllers\Api\AssetController::class, 'submitInfo']);
        //endregion
    });


    Route::post('file', [\App\Http\Controllers\Api\MediaController::class, 'uploadFile']);

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

    Route::post('newsletters', [\App\Http\Controllers\Api\NewslettersController::class, 'submit']);

    Route::post('send-mail',[\App\Http\Controllers\Api\MailController::class,'sendMail']);
});


Route::fallback(function () {
    return response()->json([
        'message' => 'Resource Not Found.'], 404);
});



