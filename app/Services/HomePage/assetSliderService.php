<?php


namespace App\Services\HomePage;

use App\Models\Asset;
use mysql_xdevapi\Exception;

class assetSliderService
{
    public static function getSlideMaterial($number_of_assets)
    {
        try
        {
            $asset = Asset::query()->with('medias')->where('order','<=',$number_of_assets)->where('status','published')->get();
            return $asset;
        }
        catch (\Exception $e)
        {

        }
    }




}
