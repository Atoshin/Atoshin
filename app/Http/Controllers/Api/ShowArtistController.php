<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShowArtist\showArtistService;
use Illuminate\Http\Request;

class ShowArtistController extends Controller
{
    public function show($id)
    {
        $artist= showArtistService::getArtist($id);
        return response()->json([
            'message'=>'asset retrieved successfully',
            'artist'=>$artist
        ]);
    }
}
