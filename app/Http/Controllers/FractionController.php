<?php

namespace App\Http\Controllers;

use App\Jobs\FractionNftJob;
use App\Models\Fraction;
use Illuminate\Http\Request;

class FractionController extends Controller
{
    public function fractionizeNft(Request $request)
    {

        $nftId = $request->input('nft_id');
        $totalSupply = $request->input('total_supply');
        $gallerySupply = $request->input('gallery_supply');
        $galleryAddress = $request->input('gallery_address');
        $salesContract = $request->input('sales_contract');

        // Dispatch job to fractionalize the NFT
        $job = new FractionNftJob($nftId, $totalSupply, $gallerySupply, $galleryAddress, $salesContract);
        $result = $job->handle();

        // Check if the transaction was successful
        if ($result) {
            // Store fraction information in the database
            Fraction::create([
                'nft_id' => $nftId,
                'total_supply' => $result['totalSupply'],
                'gallery_supply' => $result['gallerySupply'],
                'transaction_hash' => $result['txHash'],
            ]);

            return back()->with('success', 'NFT has been successfully fractionalized.');
        }

        return back()->with('error', 'Fractionalization failed.');
    }
}
