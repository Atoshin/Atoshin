<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($asset_id)
    {
        $asset=Asset::find($asset_id);
        $videos = Video::query()->where('asset_id',$asset_id)->orderBy("created_at")->get();;
        return view('admin.video.index', compact('videos', 'asset_id', 'asset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create($asset_id)
    {

        $videos=Video::find($asset_id);


        return view('admin.video.create',compact('asset_id','videos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($asset_id,Request $request)
    {
        Video::query()->create([
            'asset_id'=>$asset_id,
            'link' => $request->link,
            ]);

   return redirect()->route('videos.index', $asset_id);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {

        $video=Video::find($id);
        return view('admin.video.edit',compact('video'));
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
        $videos=Video::find($id);
        $videos->link=$request->link;


        $videos->save();
        return redirect()->route('videos.index',$videos->asset_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $videos=Video::find($id);
        $videos->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();

    }
}
