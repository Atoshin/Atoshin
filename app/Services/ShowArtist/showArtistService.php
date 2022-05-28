<?php


namespace App\Services\ShowArtist;

use App\Models\Artist;
use App\Models\Asset;
use mysql_xdevapi\Exception;

class showArtistService
{
    public static function getArtist($artist_id)
    {
        try {

            $artist = Artist::query()->with(['news', 'medias', 'auctions.medias'])->where("id", $artist_id)->first();
            $assets = Asset::query()->with('medias')->where('artist_id',$artist->id)->where('status','published')->get();
            return [$artist,$assets];
        } catch (\Exception $e) {

        }
    }


}
