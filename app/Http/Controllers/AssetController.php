<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset:: all();
        return view('admin.asset.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $galleries = Gallery::all();
        $artists = Artist::all();
        return  view('admin.asset.create',compact('categories','galleries','artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $asset = Asset::query()->create([
            'title'=>$request->title,
            'bio'=> $request->bio,
            'price'=>$request->price,
            'ownership_percentage'=>$request->ownership_percentage,
            'commission_percentage'=>$request->commission_percentage,
            'royalties_percentage'=>$request->royalties_percentage,
            'total_fractions'=>$request->total_fractions,
            'sold_fractions'=>$request->sold_fractions,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'category_id'=>$request->category_id,
            'creator_id'=>$request->creator_id,
            'artist_id'=>$request->artist_id
        ]);
        return redirect()->route('upload.page',['type'=>Asset::class,'id'=>$asset->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset=Asset::with('medias')->find($id);
        return view('admin.asset.show',compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $galleries = Gallery::all();
        $artists = Artist::all();
        $asset= Asset::query()->find($id);
        return  view('admin.asset.edit',compact('categories','galleries','artists','asset'));
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
        $asset=Asset::query()->findOrFail($id);
        $asset->title = $request->title;
        $asset->bio = $request->bio;
        $asset->price = $request->price;
        $asset->ownership_percentage = $request->ownership_percentage;
        $asset->commission_percentage = $request->commission_percentage;
        $asset->royalties_percentage = $request->royalties_percentage;
        $asset->total_fractions = $request->total_fractions;
        $asset->sold_fractions = $request->sold_fractions;
        $asset->start_date = $request->start_date;
        $asset->end_date = $request->end_date;
        $asset->category_id = $request->category_id;
        $asset->creator_id = $request->creator_id;
        $asset->artist_id = $request->artist_id;
        $asset->save();

        return redirect()->route('assets.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $asset = Asset::query()->findOrFail($id);
        $asset->delete();
        return redirect()->back();
    }
}
