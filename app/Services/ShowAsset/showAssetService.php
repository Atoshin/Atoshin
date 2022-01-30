<?php


namespace App\Services\ShowAsset;

use App\Models\Artist;
use App\Models\Asset;
use mysql_xdevapi\Exception;

class showAssetService
{
    public static function getAsset($asset_id)
    {
        try
        {
            $asset = Asset::query()->with(['medias','artist','gallery','videoLinks.media'])->where("id",$asset_id)->first();
            return $asset;
        }
        catch (\Exception $e)
        {

        }
    }




}
