<?php

namespace App\Http\Controllers;

use App\Http\Traits\MediaTrait;
use App\Models\Contract;
use App\Models\Gallery;
use App\Models\Wallet;
use App\Models\Media;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery:: all();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $gallery = Gallery::query()->create([
            'name' => $request->name,
            'bio' => $request->bio,
            'avatar' => $request->avatar,
        ]);
        Wallet::query()->create([
            'wallet_address' => $request->wallet_address,
            'walletable_id' => $gallery->id,
            'walletable_type' => 'App\Models\Gallery'
        ]);







        return redirect()->route('upload.page',['type'=>Gallery::class,'id'=>$gallery->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id){

    $gallery=Gallery::find($id);
        return view('admin.gallery.show',compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery =Gallery::find($id);

        return view('admin.gallery.edit', compact( 'gallery'));
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
        $gallery =Gallery::find($id);
        $gallery->name=$request->name;
        $gallery->bio=$request->bio;
        $gallery->avatar=$request->avatar;
        $wallet = $gallery->wallet;
        if ($wallet) {
            $wallet->wallet_address = $request->wallet_address;
            $wallet->save();
        } else {
            Wallet::query()->create([
                'wallet_address' => $request->wallet_address,
                'walletable_id' => $gallery->id,
                'walletable_type' => 'App\Models\Gallery'
            ]);
        }
        $gallery->save();
        return redirect()->route('galleries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $gallery =Gallery::find($id);
        $wallet = $gallery->wallet;
        if ($wallet)
        {
            $wallet->delete();
        }
        $gallery->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }
}
