<?php

namespace App\Http\Controllers;

use App\Models\VideoLink;
use Illuminate\Http\Request;

class VideoLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type , $id)
    {
        $video_links = VideoLink::query()->where('video_linkable_type',$type)->where('video_linkable_id',$id)->get();
        return view('admin.videoLink.crud',compact('type','id','video_links'));
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
    public function store(Request $request , $type , $id)
    {
        VideoLink::query()->create([
            'link' => $request->link,
            'video_linkable_type' => $type,
            'video_linkable_id' => $id
        ]);
        return redirect()->back();
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
        $videoLink =VideoLink::find($id);
        $videoLink->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }
}
