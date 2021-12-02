<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Services\HomePage\artistListService;
use App\Services\HomePage\assetSliderService;
use App\Services\HomePage\galleryService;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Route;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function gethomePageMaterial()
    {
        try
        {
            $number_of_assets = \request()->number_of_assets;
            $number_of_artists = \request()->number_of_artists;
            $gallery_id = \request()->gallery_id;

            $artists = artistListService::getArtists($number_of_artists);
            $assets = assetSliderService::getSlideMaterial($number_of_assets);
            $gallery = galleryService::getGallery($gallery_id);

            return response()->json([
                'message' => 'getting_the_home_page_material_was_successful',
                'assets' => $assets,
                'gallery' => $gallery,
                'artists' => $artists

            ], 200);
        }

        catch (\Exception $e)
        {
            return response()->json([
                'message' => 'getting_the_home_page_material_failed',
            ], 422);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
