<?php


namespace App\Services\ShowUser;

use App\Models\Artist;
use App\Models\Asset;
use App\Models\Minted;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use mysql_xdevapi\Exception;

class showUserService
{
    public static function getUser($wallet_address)
    {
        $wallet = Wallet::query()->where('wallet_address', $wallet_address)->first();
        $user = User::query()->find($wallet->walletable_id)->load('media', 'wallet');
        $transactions = $user->transactions;
        $assets = [];
        foreach ($transactions as $transaction) {
            $minted = Minted::query()->where('txn_id', $transaction->id)->first();
            array_push($assets, $minted->contract->asset->load('medias'));
        }
        $user->assets = $assets;
        return $user;
    }


}
