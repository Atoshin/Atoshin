<?php


namespace App\Services\HomePage;


use App\Models\Gallery;
use mysql_xdevapi\Exception;

class galleryService
{
    public static function getGallery()
    {
        try
        {

            $gallery = Gallery::query()->with(['medias','videoLinks.media'])->where('status','published')->take(4)->get();
            return $gallery;
        }
        catch (\Exception $e)
        {

        }
    }




}
