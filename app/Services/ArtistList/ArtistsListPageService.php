<?php


namespace App\Services\ArtistList;


use App\Models\Artist;
use App\Models\Gallery;
use mysql_xdevapi\Exception;

class ArtistsListPageService
{
    public static function getArtists()
    {
        try {
            $artists = Artist::query()->with(['medias'])->where('status', 'published')->where('order', '!=', null)->get()->sortBy('order')->values()->all();
            return $artists;
        } catch (\Exception $e) {

        }
    }


}
