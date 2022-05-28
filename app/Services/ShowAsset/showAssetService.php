<?php


namespace App\Services\ShowAsset;

use App\Models\Artist;
use App\Models\Asset;
use App\Models\Minted;
use App\Models\Transaction;
use mysql_xdevapi\Exception;

class showAssetService
{
    public static function getAsset($asset_id)
    {
        try {
            $asset = Asset::query()->with(['medias', 'artist', 'gallery', 'videoLinks.media', 'contracts.minted'])->where("id", $asset_id)->first();
            $txns = [];
            $buyTransactions = [];
            foreach ($asset->contracts as $contract) {
                if ($contract->minted) {
                    array_push($txns, $contract->minted->txn_hash);
                    if ($contract->minted->transaction){
                        array_push($buyTransactions, $contract->minted->transaction->txn_hash);
                    }
                }
            }
            $txns = array_unique($txns);
            $buyTransactions = array_unique($buyTransactions);
            $uniqueBuyTransactions = [];
            foreach ($buyTransactions as $buyTransactionHash) {
                $txn = Transaction::query()->where('txn_hash', $buyTransactionHash)->with('transactable.wallet')->first();
                array_push($uniqueBuyTransactions, $txn);
            }


            $transactions = [];
            foreach ($txns as $txn) {
                $minted = Minted::query()->where('txn_hash', $txn)->first();
                array_push($transactions, ['txnHash' => $txn, 'createdAt' => $minted->created_at]);
            }
            $asset->mintTransactions = $transactions;
            $asset->buyTransactions = $uniqueBuyTransactions;
            return $asset;
        } catch (\Exception $e) {

        }
    }


}
