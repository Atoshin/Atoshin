<?php


namespace App\Services\ShowUser;

use App\Models\Artist;
use App\Models\Asset;
use App\Models\User;
use App\Models\Wallet;
use mysql_xdevapi\Exception;

class showUserService
{
    public static function getUser($wallet_address)
    {
        $wallet = Wallet::query()->where('wallet_address', $wallet_address)->first();
        $user = User::query()->find($wallet->walletable_id)->load('media', 'wallet');
        return $user;
    }


}
