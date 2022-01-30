<?php


namespace App\Services\GalleryList;


use App\Models\Gallery;
use mysql_xdevapi\Exception;

class GalleryList
{
    public static function getGalleries()
    {
        try
        {
            $galleries = Gallery::query()->with(['medias'])->where('status','published')->get();
            return $galleries;
        }
        catch (\Exception $e)
        {

        }
    }




}
