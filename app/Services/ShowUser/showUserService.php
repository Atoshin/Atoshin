<?php


namespace App\Services\ShowUser;

use App\Models\Artist;
use App\Models\Asset;
use App\Models\User;
use mysql_xdevapi\Exception;

class showUserService
{
    public static function getUser($user_id)
    {
        try {
            $user = User::query()->find($user_id)->load('media', 'wallet');
            return $user;
        } catch (\Exception $e) {

        }
    }




}
