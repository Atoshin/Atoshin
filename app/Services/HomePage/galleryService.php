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

            $gallery = Gallery::query()->with(['medias','videoLinks.media'])->where('status','published')->where('order','!=' ,null)->get()->sortBy('order')->values()->all();
            return $gallery;
        }
        catch (\Exception $e)
        {

        }
    }




}
