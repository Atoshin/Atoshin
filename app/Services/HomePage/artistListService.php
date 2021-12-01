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
            $artists = Artist::query()->with('medias')->take($number_of_artists)->get();
            return $artists;
        }
        catch (\Exception $e)
        {

        }
    }




}
