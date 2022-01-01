<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Contract;
use App\Models\Minted;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    public function getContracts(Asset $asset)
    {
        $contracts = Contract::query()->where('asset_id', $asset->id)->with('media')->get();
        $asset = Asset::query()->where('id', $asset->id)->with('medias')->first();
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


    public function setIpfsHash(Request $request, Contract $contract)
    {
        $request->validate([
            'ipfs-hash' => 'required|string|min:46|max:46'
        ]);

        try {
            $contract->hash = request('ipfs-hash');
            $contract->save();
            return response()->json([
                "message" => 'hash stored successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e
            ], 400);
        }
    }

    public function setMintRecord(Request $request, Asset $asset)
    {
        $request->validate([
            'previousTokenId' => 'required|numeric',
            'mintedContractsLength' => 'required|numeric',
            'signerWalletAddress' => 'required|string|regex:/0x[a-fA-F0-9]{40}'
        ]);
        try {
            if ($request->mintedContractsLength == $asset->contracts->count()) {
                DB::transaction(function () use ($asset, $request) {
                    foreach ($asset->contracts as $idx => $contract) {
                        $rec = Minted::query()->create([
                            'contract_id' => $contract->id,
                            'token_id' => $request->previousTokenId + ($idx + 1),
                        ]);
                        Wallet::query()->create([
                            'wallet_address' => $request->signerWalletAddress,
                            'walletable_id' => $rec->id,
                            'walletable_type' => Minted::class
                        ]);
                    }
                });
                return response()->json([
                    'message' => 'records stored successfully'
                ]);
            } else {
                return response()->json([
                    'message' => 'we have encountered a serious issue. please contact support!'
                ], 500);
            }

        } catch (Exception $exception) {
            return response()->json([
                "message" => $exception
            ], 400);
        }
    }
}
