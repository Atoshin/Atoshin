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
            $gallery = Gallery::query()->where('id',$gallery_id)->first();
            return $gallery;
        }
        catch (\Exception $e)
        {

        }
    }




}
