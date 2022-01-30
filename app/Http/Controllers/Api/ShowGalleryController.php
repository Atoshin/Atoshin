<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShowGallery\showGalleryService;
use Illuminate\Http\Request;

class ShowGalleryController extends Controller
{
    public function show($id)
    {
        $gallery = showGalleryService::getGallery($id);
        return response()->json([
            'message' => 'gallery retrieved successfully',
            'artCenter' => $gallery
        ]);
    }
}
