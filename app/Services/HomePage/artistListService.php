<?php


namespace App\Services\HomePage;

use App\Models\Artist;
use App\Models\Asset;
use mysql_xdevapi\Exception;

class artistListService
{
    public static function getArtists($number_of_artists)
    {
        try
        {
            $artists = Artist::query()->with('medias')->where('status','unpublished')->where('order','!=',null)->get()->sortBy('order')->values()->all();
            return $artists;
        }
        catch (\Exception $e)
        {

        }
    }




}
