<?php


namespace App\Services\ArtistList;


use App\Models\Artist;
use App\Models\Gallery;
use mysql_xdevapi\Exception;

class ArtistsListPageService
{
    public static function getArtists()
    {
        try
        {
            $artists = Artist::query()->with(['medias'])->get();
            return $artists;
        }
        catch (\Exception $e)
        {

        }
    }




}
