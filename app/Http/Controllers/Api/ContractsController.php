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
        $NFTpath = resource_path() . "/artifacts/contracts/NFT.sol/NFT.json";
        $NFTjson = json_decode(file_get_contents($NFTpath), true);
        $NFTabi = $NFTjson['abi'];
        $MarketPath = resource_path() . "/artifacts/contracts/Market.sol/NFTMarket.json";
        $MarketJson = json_decode(file_get_contents($MarketPath), true);
        $MarketAbi = $MarketJson['abi'];
    }
}
