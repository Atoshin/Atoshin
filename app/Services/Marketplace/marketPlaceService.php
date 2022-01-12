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
            $assets = Asset::query()->with(['artist','medias','gallery'])->get();
            return $assets;
        }
        catch (\Exception $e)
        {

        }
    }




}
