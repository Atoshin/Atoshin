<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\news\storeNews;
use App\Http\Requests\admin\news\updateNews;
use App\Models\Artist;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($artist_id)
    {
        $artist = Artist::find($artist_id);
        $news = News::query()->where('artist_id', $artist_id)->orderBy('created_at')->get();
        return view('admin.news.index',compact('news', 'artist', 'artist_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($artist_id)
    {
        return view('admin.news.create',compact('artist_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeNews $request , $artist_id)
    {
        News::query()->create([
         'artist_id'=>$artist_id,
         'link'=>$request->link,
         'title'=>$request->title
        ]);

        return redirect()->route('news.index',$artist_id);
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
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateNews $request, $id)
    {
        $news = News::find($id);
        $news->link = $request->link;
        $news->title = $request->title;
        $news->save();
        return redirect()->route('news.index',$news->artist_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();

    }
}
