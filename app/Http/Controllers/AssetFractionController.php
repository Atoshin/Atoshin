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

        try {

            $job = new FractionNftJob($request->tokenName,$request->tokenSymbol);
            $output = $job->handle();
//            dd(str_contains($output, 'Error:'));
            if (is_string($output) && str_contains($output, 'Error:')) {
                // Log or handle the error message as needed
                return redirect()->back()->with(['success'=>'false','error'=>$output]);
            }
            $contract = AssetFraction::create([
                'asset_id' => $asset_id,
                'total_supply' => $asset->total_fractions,
                'gallery_supply' => $asset->ownership_percentage,
                'atoshin_supply'=>$asset->royalties_percentage,
                'token_name'=>$request->tokenName,
                'token_symbol'=>$request->tokenSymbol,
                'token_address'=>$output['fractionTokenAddress']
            ]);
            Transaction::create([
                'txn_hash' => $output['transactionHash'],
                'transactable_id' => $contract->id,
                'transactable_type' => AssetFraction::class,
                'token_quantity' => 0,
            ]);
            return redirect()->back()->with(['success'=>'true','title'=>'Fraction received!']);
        }catch (\Exception $exception){
            return redirect()->back()->with(['success'=>'false','error'=>$exception->getMessage()]);
        }

    }
}
