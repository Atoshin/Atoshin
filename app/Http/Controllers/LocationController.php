<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\location\storeLocation;
use App\Models\Gallery;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($gallery_id)

    {
        $gallery = Gallery::find($gallery_id);
        $locations = Location::where('gallery_id', $gallery_id)->get();
        return view('admin.location.index', compact('locations', 'gallery_id', 'gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create($gallery_id)
    {
        $gallery = Gallery::query()->find($gallery_id);
        $location = $gallery->location;
        return view('admin.location.create', compact('gallery_id', 'location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($gallery_id, storeLocation $request)
    {
        $location = Gallery::query()->find($gallery_id)->location;
        if ($location) {
            $location->update([
                'lat' => $request->lat,
                'long' => $request->long,
                'address' => $request->address,
                'telephone' => $request->telephone,
            ]);
        } else {
            Location::query()->create([
                'gallery_id' => $gallery_id,
                'lat' => $request->lat,
                'long' => $request->long,
                'address' => $request->address,
                'telephone' => $request->telephone,
            ]);
        }

        return redirect()->route('galleries.index', $gallery_id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
