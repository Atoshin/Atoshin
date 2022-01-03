<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShowGallery\showGalleryService;
use Illuminate\Http\Request;

class ShowGalleryController extends Controller
{
    public function show($id)
    {
        $artist= showGalleryService::getGallery($id);
        return response()->json([
            'message'=>'asset retrieved successfully',
            'artist'=>$artist
        ]);
    }
}
