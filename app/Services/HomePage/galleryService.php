<?php


namespace App\Services\HomePage;


use App\Models\Gallery;
use mysql_xdevapi\Exception;

class galleryService
{
    public static function getGallery($gallery_id)
    {
        try
        {

            $gallery = Gallery::query()->with(['medias','videoLinks.media'])->where('id',$gallery_id)->where('status','published')->first();
            return $gallery;
        }
        catch (\Exception $e)
        {

        }
    }




}
