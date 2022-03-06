<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\gallery\storeGallery;
use App\Http\Requests\admin\gallery\updateGallery;
use App\Http\Requests\admin\users\updateUser;
use App\Http\Traits\MediaTrait;
use App\Models\Contract;
use App\Models\Gallery;
use App\Models\Location;
use App\Models\VideoLink;
use App\Models\Wallet;
use App\Models\Media;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    use MediaTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::query()->orderBy("created_at", "desc")->get();

        return view('admin.gallery.index', compact('galleries',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(storeGallery $request)
    {
        DB::transaction(function () use ($request, &$gallery) {
            $gallery = Gallery::query()->create([
                'name' => $request->name,
                'bio' => $request->bio,
                'summary' => $request->summary,
                'avatar' => $request->avatar,
                'website' => $request->website,
                'youtube' => $request->youtube,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'facebook' => $request->facebook,
                'linkedin' => $request->linkedin,
                'order' => $request->order,
//                'status' => $request->status,
            ]);
            Location::query()->create([
                'lat' => $request->lat,
                'long' => $request->long,
                'address' => $request->address,
                'telephone' => $request->telephone,
                'gallery_id' => $gallery->id
            ]);
            Wallet::query()->create([
                'wallet_address' => $request->wallet_address,
                'walletable_id' => $gallery->id,
                'walletable_type' => 'App\Models\Gallery'
            ]);
        });

        return redirect()->route('upload.page', ['type' => Gallery::class, 'id' => $gallery->id,'edit'=>0]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {

        $gallery = Gallery::with('medias', 'assets', 'videoLinks')->find($id);

        return view('admin.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::query()->find($id);
        $location = $gallery->location;
        return view('admin.gallery.edit', compact('gallery', 'location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(updategallery $request, $id)
    {
        $gallery = Gallery::query()->find($id);
        $gallery->name = $request->name;
        $gallery->bio = $request->bio;
        $gallery->summary = $request->summary;
        $gallery->avatar = $request->avatar;
        $gallery->website = $request->website;
        $gallery->youtube = $request->youtube;
        $gallery->instagram = $request->instagram;
        $gallery->twitter = $request->twitter;
        $gallery->facebook = $request->facebook;
        $gallery->linkedin = $request->linkedin;
        $gallery->order = $request->order;
//        $gallery->status = $request->status;
        $wallet = $gallery->wallet;
        $location = $gallery->location;
        if ($location) {
            $location->lat = $request->lat;
            $location->long = $request->long;
            $location->address = $request->address;
            $location->telephone = $request->telephone;
            $location->save();
        } else {
            Location::query()->create([
                'lat' => $request->lat,
                'long' => $request->long,
                'address' => $request->address,
                'telephone' => $request->telephone,
                'gallery_id' => $gallery->id
            ]);
        }
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
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $gallery = Gallery::query()->find($id);
        $wallet = $gallery->wallet;
        if ($wallet) {
            $wallet->delete();
        }
        $gallery->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }


    public function changeStatus(Request $request, Gallery $gallery)
    {
        $gallery->status = $request->status;
        $gallery->save();

        return redirect()->back();
    }
}
