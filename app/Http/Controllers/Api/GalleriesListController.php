<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GalleryList\GalleryList;
use App\Services\Marketplace\marketPlaceService;
use Illuminate\Http\Request;

class GalleriesListController extends Controller
{
    public function getGalleries()
    {
        try {
            $galleries = GalleryList::getGalleries();
            return response()->json([
                'message'=>'galleries_retrieved successfully',
                'assets'=>$galleries
            ]);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message'=>'an error occured',
                'error'=> $e
            ]);
        }
    }
}
