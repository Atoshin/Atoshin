<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShowArtist\showArtistService;
use Illuminate\Http\Request;

class ShowArtistController extends Controller
{
    public function show($id)
    {
        $data = showArtistService::getArtist($id);
        return response()->json([
            'message' => 'artist retrieved successfully',
            'artist' => $data[0],
            'relatedAssets'=>$data[1]
        ]);
    }
}
