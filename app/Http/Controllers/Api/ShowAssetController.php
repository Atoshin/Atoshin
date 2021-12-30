<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShowAsset\showAssetService;
use Illuminate\Http\Request;

class ShowAssetController extends Controller
{
    public function show($id)
    {
        $asset= showAssetService::getAsset($id);
        return response()->json([
            'message'=>'asset retrieved successfully',
            'asset'=>$asset
        ]);
  }
}
