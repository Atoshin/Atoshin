<?php

namespace App\Http\Controllers;

use App\Jobs\deployFractionContract;
use App\Jobs\MintNFTJob;
use App\Models\Gallery;
use App\Models\galleryContract;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GalleryContractController extends Controller
{
    public function create($id){
        $gallery = Gallery::with(['galleryContract','wallet'])->where('id',$id)->first();

        return view('admin.galleryContract.create',compact('gallery'));
    }

    public function store(Request $request,$gallery_id){
        $gallery = Gallery::with(['galleryContract','wallet'])->where('id',$gallery_id)->first();
        if($gallery->galleryContract !== null){
            return redirect()->back()->with('contract for this gallery already exists!');
        }
        try {
            $job = new deployFractionContract($gallery->wallet->wallet_address);
            $output = $job->handle();// Execute the job and get the tokenId

            $contract = GalleryContract::create([
                'contract_address' => $output['contractAddress'],
                'contract' => json_encode($output['contract']),
                'gallery_id' => $gallery->id
            ]);

            Transaction::create([
                'txn_hash' => $output['deploymentTransaction'],
                'transactable_id' => $contract->id,
                'transactable_type' => GalleryContract::class,
                'token_quantity' => 0,
            ]);

            return redirect()->back()->with(['success'=>'true','title'=>'Gallery contract deployed successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['success'=>'false','error'=>$e->getMessage()]);
        }

    }
}
