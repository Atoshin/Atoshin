<?php

namespace App\Http\Controllers;

use App\Jobs\deployFractionContract;
use App\Jobs\FractionNftJob;
use App\Models\Asset;
use App\Models\AssetFraction;
use App\Models\galleryContract;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AssetFractionController extends Controller
{
    public function fraction(Request $request,$asset_id)
    {

        $asset = Asset::with(['assetFraction', 'metadata','gallery'])->where('id', $asset_id)->first();
        if (!$asset->metadata) {
            return redirect()->back()->with(['success'=>'false','title'=>'Mint an nft for this asset first!']);
        }
        if ($asset->assetFraction) {
            return redirect()->back()->with(['success'=>'false','title'=>'This asset has already been fractioned']);
        }

        $galleryShare = ($asset->ownership_pecentage * $asset->total_fractions)/100;
        $atoshinShare = ($asset->royalties * $asset->total_fractions)/100;
        try {
            $job = new FractionNftJob($asset->gallery->galleryContract->contract_address,env('NFT_CONTRACT_ADDRESS'),$asset->metadata->token_id,$request->tokenName,$request->tokenSymbol,$asset->total_fractions,$galleryShare,$atoshinShare);
            $output = $job->handle();
            dd($output);
//            Transaction::create([
//                'txn_hash' => $output['deploymentTransaction'],
//                'transactable_id' => $contract->id,
//                'transactable_type' => AssetFraction::class,
//                'token_quantity' => 0,
//            ]);
        }catch (\Exception $exception){
            return redirect()->back()->with(['success'=>'false','error'=>$exception->getMessage()]);
        }

    }
}
