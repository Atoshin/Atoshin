<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ArtistList\ArtistsListPageService;
use Illuminate\Http\Request;

class ArtistsListController extends Controller
{
    public function getArtists()
    {
        try {
            $artists = ArtistsListPageService::getArtists();
            return response()->json([
                'message' => 'artists_retrieved successfully',
                'artists' => $artists
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'an error occured',
                'error' => $e
            ]);
        }
    }
}
