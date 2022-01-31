<?php


namespace App\Services\ShowArtist;

use App\Models\Artist;
use App\Models\Asset;
use mysql_xdevapi\Exception;

class showArtistService
{
    public static function getArtist($artist_id)
    {
        try
        {
            $artist = Artist::query()->with(['news','medias','assets.medias'])->where("id",$artist_id)->first();
            return $artist;
        }
        catch (\Exception $e)
        {

        }
    }




}
