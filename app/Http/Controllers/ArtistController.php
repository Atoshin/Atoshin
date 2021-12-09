<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $artists =Artist:: all();
        return view('admin.artist.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $artist = Artist::query()->create([
            'full_name' => $request->full_name,
            'avatar' => $request->avatar,
            'bio' => $request->bio,
            'website' => $request->website,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
        ]);


        return redirect()->route('upload.page',['type'=>Artist::class,'id'=>$artist->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist=Artist::with('medias')->find($id);
        return view('admin.artist.show',compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artist =Artist::find($id);

        return view('admin.artist.edit', compact( 'artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $artist =Artist::find($id);
        $artist->full_name=$request->full_name;
        $artist->avatar=$request->avatar;
        $artist->bio=$request->bio;
        $artist->website=$request->website;
        $artist->youtube=$request->youtube;
        $artist->instagram=$request->instagram;
        $artist->twitter=$request->twitter;
        $artist->facebook=$request->facebook;
        $artist->linkedin=$request->linkedin;
        $artist->save();
        return redirect()->route('artists.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $artist =Artist::find($id);
        $artist->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }
}
