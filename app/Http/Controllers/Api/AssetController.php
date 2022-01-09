<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Contract;
use App\Models\Minted;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getContract($id)
    {
        try {
            $contract = Contract::query()->where('id', $id)->with('media')->first();
            $asset = $contract->asset->load('medias');
            if ($contract->minted) {
                return response()->json([
                    'message' => 'contract already minted'
                ], 400);
            } else {
                return response()->json([
                    'asset' => $asset,
                    'contract' => $contract,
                    'addresses' => [
                        'NFT' => env('NFT_CONTRACT_ADDRESS'),
                        'Market' => env('MARKET_CONTRACT_ADDRESS')
                    ],
                    'keys' => [
                        'projectId' => env('IPFS_PROJECT_ID'),
                        'projectSecret' => env('IPFS_PROJECT_SECRET')
                    ]
                ]);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception
            ], 500);
        }
    }

    /**
     * @param Asset $asset
     * @return JsonResponse
     */
    public function getContracts(Asset $asset)
    {
        $contracts = Contract::query()->where('asset_id', $asset->id)->with('media')->get();
        $asset = Asset::query()->where('id', $asset->id)->with('medias')->first();
        $notMinted = [];
        foreach ($contracts as $contract) {
            if (!$contract->minted) {
                array_push($notMinted, $contract);
            }
        }


        return response()->json([
            'asset' => $asset,
            'contracts' => $notMinted,
            'addresses' => [
                'NFT' => env('NFT_CONTRACT_ADDRESS'),
                'Market' => env('MARKET_CONTRACT_ADDRESS')
            ],
            'keys' => [
                'projectId' => env('IPFS_PROJECT_ID'),
                'projectSecret' => env('IPFS_PROJECT_SECRET')
            ]
        ]);
    }


    /**
     * @param Request $request
     * @param Contract $contract
     * @return JsonResponse
     */
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

    /**
     * @param Request $request
     * @param Asset $asset
     * @return JsonResponse
     */
    public function setAssetMintRecord(Request $request, Asset $asset)
    {
        $request->validate([
            'previousTokenId' => 'required|numeric',
            'mintedContractsLength' => 'required|numeric',
            'signerWalletAddress' => 'required|string|regex:/0x[a-fA-F0-9]{40}/'
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

    /**
     * @param Request $request
     * @param Contract $contract
     * @return JsonResponse
     */
    public function setContractMintRecord(Request $request, Contract $contract)
    {
        $request->validate([
            'tokenId' => 'required|numeric',
            'signerWalletAddress' => 'required|string|regex:/0x[a-fA-F0-9]{40}/'
        ]);
        try {
            DB::transaction(function () use ($contract, $request) {
                $rec = Minted::query()->create([
                    'contract_id' => $contract->id,
                    'token_id' => $request->tokenId,
                ]);
                Wallet::query()->create([
                    'wallet_address' => $request->signerWalletAddress,
                    'walletable_id' => $rec->id,
                    'walletable_type' => Minted::class
                ]);
            });
            return response()->json([
                'message' => 'records stored successfully'
            ]);
        } catch (Exception $exception) {
            return response()->json(["message" => $exception], 400);
        }
    }
}
