<?php


namespace App\Services\Marketplace;

use App\Models\Artist;
use App\Models\Asset;
use mysql_xdevapi\Exception;

class marketPlaceService
{
    public static function getAssets()
    {
        try
        {
            $assets = Asset::query()->with(['artist','medias','gallery'])->where('status','published')->get()->sortBy('order')->values()->all();
            return $assets;
        }
        catch (\Exception $e)
        {

        }
    }




}
