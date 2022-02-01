<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\gallerying\storeGallerying;
use App\Http\Requests\admin\gallerying\updateGallerying;
use App\Models\Artist;
use App\Models\Gallery;
use App\Models\Gallerying;
use Illuminate\Http\Request;

class GalleryingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function indexgallerying($gallery_id)
    {      $gallery = Gallery::find($gallery_id);
         $galleryings = Gallerying::query()->where('gallery_id',$gallery_id)->orderBy("created_at", "desc")->get();
        return view('admin.gallerying.index',compact('galleryings','gallery','gallery_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function creategallerying ($gallery_id, $gallery)
    {
        return view('admin.gallerying.create',compact('gallery_id','gallery'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storegallerying(storeGallerying $request, $gallery_id)
    {
        if ($request->is_owner == 'on') {
        Gallerying::query()->create([
            'gallery_id'=>$gallery_id,
            'full_name' => $request->full_name,
            'title' => $request->title,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'is_owner' => true,
            ]);}
        else {
            Gallerying::query()->create([
                'gallery_id'=>$gallery_id,
                'full_name' => $request->full_name,
                'title' => $request->title,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'is_owner' => false,         ]);
        }
              return redirect()->route('index.gallerying',$gallery_id);
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

        $gallerying =Gallerying::find($id);

        return view('admin.gallerying.edit', compact( 'gallerying'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(updateGallerying $request, $id)
    {
        $gallerying =Gallerying::find($id);
        $gallerying->full_name=$request->full_name;
        $gallerying->title=$request->title;
        $gallerying->email=$request->email;
        $gallerying->telephone=$request->telephone;
        if ($request->is_owner == 'on') {
            $gallerying->is_owner = true;
        } else {
            $gallerying->is_owner = false;
        }
        $gallerying->save();
        return redirect()->route('index.gallerying', $gallerying->gallery_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function destroy($id)
    {
        $gallerying = Gallerying::find($id);
        $gallerying->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }

}
