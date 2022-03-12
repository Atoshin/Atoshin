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

    Route::get('landing/content', [\App\Http\Controllers\Api\LandingController::class, 'getLandingContent']);
    Route::get('homepage/material', [\App\Http\Controllers\Api\HomePageController::class, 'gethomePageMaterial'])->name('homepage');
    Route::post('assets/{type}/{asset_id}/media/upload', [\App\Http\Controllers\Api\MediaController::class, 'upload']);
    Route::post('wallets/store/signature', [\App\Http\Controllers\Api\WalletController::class, 'storeSignature']);
    Route::post('wallets/store', [\App\Http\Controllers\Api\WalletController::class, 'storeWallet']);
    Route::get('asset/{id}/show', [\App\Http\Controllers\Api\ShowAssetController::class, 'show']);
    Route::get('contract/info/U2FsdGVkX19II91sk2bUAmHaWGKBe3qaK37VJskHkMI/Y7tKqwo+Ax0tBtExuUkDN8PjmJPxilwde39QMdubV6HeDp4s5auWtSd07T/yIT/KapYnO+lT2sTPLME7M2JnU+pEMNsks0DL1ivwK3tMxh0AC78RgfyJcXiRWIQnZZise5PYI2Xpn2cx1EJvbKPsox8KBY9VCW4IazQnVejA0nU9+MJuPRZ4oLKqgWLtticjTzrEughhad5wQcok6ctllPSAHBjpYTQqgOWk4aYTF92BhmZvAhT+FrPztYIfu4vIhmHClYcEBWeXEtcfldj7Qi9PE1cGa+UWpAibf6TyqpkjFliNDBXrHBW3bVWHNp97yueTPeRDa2tzeSTz4G5zYiv4LPSalN1H0tUgyCo/xnhTpvL0iKDVvvjiXvQ9jyCneMaaZw5YtFqIYX6sYfPOesvn+u01GutAFaHOAvH+kkQsX09/wp3VJSKviwzQQ0AD2sas/vI/UkCX3N8WwNShsJYImkPVjZcxHuDUtzxuzePbdsJB2AWMgZmAyZS+o7lVmg330KJYr6ukWrVcyWLaw6n7VwklsL3825OVJ+6BZZWct+HaSWutcp1xUtuK0LkkZ6lt8S0wVQCA85mWyUUdsErclXUGTT1s0JX00XNj9WLvTxYnAB14e1gbnUNPMXJUm2tMbmXrxYeq5OHx0+R01IDEvYXPith66SxbdDO4vLG7wB0FQ3gliN08AUoFMpa0ZrhAT4Cy/PQ0iM3rHr8S4TjCqOU+XmBD0whGkrbgjEa7bKlzqRWXrAVx402sY0E1OHBcLX/HEPnuY9wW29EOHPa1HY7yKbOYXvzsV3ZKfUi97s6fGY0I9ojYTOBsFkrJNrn+du9UEKpLtBPgLdZ+Zb9AfD+ATCC/fyukHSQFLY1mYQmL6YJ0WQ0HPaI32zP9Oc+X9K9Gilho/+JHcaEaRrWVgsUH1eY2UBQM/3E/th/14irgQp+Z6VYPWpwVGryta4KMPLPHdFY4y+/GvMo/xhkkLLYalkwAD9tCWT3i1CJsLFWc3N3cKIRdgIJwqwxh0oSlHKsODpxEfCeP5Cohf0mFfiCFQ1V4z9HMFvRZBez30nc6rC9eaqRc7wKzrJ/jynXvDlC1eE+tet9pqBRfDW7qQIKR9rQqta8qN2V1AscKzFI+nLz+OLFIXjDQLaa24Sgc7wpt4GARYDE/+Bi2oS9kT/LVrRl1Vp0xe1ZPNIK9SxUGNC1WaQjzhXLfsOhPiSnnGnIevCofsDPrgpaozkhrYt3Bo=', [\App\Http\Controllers\Api\ContractsController::class, 'show']);


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



