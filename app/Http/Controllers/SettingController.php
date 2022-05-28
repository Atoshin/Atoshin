<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function setting()
    {
//        $galleries_count = Gallery::query()->count();
//        $artists_count = Artist::query()->count();
//        $assets_count = Asset::query()->count();
//        $users_count = User::query()->count();

        $MarketPath = resource_path() . "/artifacts/contracts/Market.sol/NFTMarket.json";
        $MarketJson = json_decode(file_get_contents($MarketPath), true);
        $MarketAbi = $MarketJson['abi'];

        $marketAddress = env('MARKET_CONTRACT_ADDRESS');
        $nftAddress = env('NFT_CONTRACT_ADDRESS');
        $provider = env('JSONRPC_ENDPOINT');

        return view('admin.setting');
    }
}
