<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Contract;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function getContracts(Asset $asset)
    {
        $contracts = Contract::query()->where('asset_id', $asset->id)->with('media')->get();
        $asset = Asset::query()->where('id', $asset->id)->with('medias')->get();
        $errs = [];
        foreach ($contracts as $contract) {
            if (!$contract->hash) {
                array_push($errs, "contract number: $contract->contract_number has no hash. please check before minting!");
            }
        }

        if (count($errs) > 0) {
            return response()->json([
                'data' => $errs
            ], 400);
        }

        return response()->json([
            'asset' => $asset,
            'contracts' => $contracts,
            'addresses' => [
                'NFT' => env('NFT_CONTRACT_ADDRESS'),
                'Market' => env('MARKET_CONTRACT_ADDRESS')
            ]
        ]);
    }
}
