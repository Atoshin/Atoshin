<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    public function show()
    {
        $NFTPath = resource_path() . "/artifacts/contracts/NFT.sol/NFT.json";
        $NFTJson = json_decode(file_get_contents($NFTPath), true);
        $NFTAbi = $NFTJson['abi'];

        $MarketPath = resource_path() . "/artifacts/contracts/Market.sol/NFTMarket.json";
        $MarketJson = json_decode(file_get_contents($MarketPath), true);
        $MarketAbi = $MarketJson['abi'];


        return response()->json([
            'Market' => [
                'address' => env('MARKET_CONTRACT_ADDRESS'),
                'abi' => $MarketAbi
            ],
            'NFT' => [
                'address' => env('NFT_CONTRACT_ADDRESS'),
                'abi' => $NFTAbi
            ],
            'RPCEndPoint' => env('JSONRPC_ENDPOINT')
        ]);
    }
}
