<?php


namespace App\Services\ShowGallery;

use App\Models\Artist;
use App\Models\Asset;
use App\Models\Gallery;
use mysql_xdevapi\Exception;

class showGalleryService
{
    public static function getGallery($gallery_id)
    {
        try
        {
            $gallery = Gallery::query()->with(['medias','location','assets.medias','videoLinks'])->where("id",$gallery_id)->first();
            return $gallery;
        }
        catch (\Exception $e)
        {

        }
    }




}
