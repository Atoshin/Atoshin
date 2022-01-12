<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Marketplace\marketPlaceService;
use http\Env\Response;
use Illuminate\Http\Request;

class MarketPlaceController extends Controller
{
    public function getAssets()
    {
        try {
            $assets = marketPlaceService::getAssets();
            return response()->json([
                'message'=>'assets_retrieved successfully',
                'assets'=>$assets
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message'=>'an error occured',
                'error'=> $e
            ]);
        }

    }
}
