<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\asset\storeAsset;
use App\Http\Requests\admin\asset\updateAsset;
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
        $assets = Asset:: query()->orderBy("created_at", "desc")->get();
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
        return view('admin.asset.create', compact('categories', 'galleries', 'artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(storeAsset $request)
    {

        $asset = Asset::query()->create([
            'title' => $request->title,
            'bio' => $request->bio,
            'price' => $request->price,
            'ownership_percentage' => $request->ownership_percentage,
//            'commission_percentage' => 0,
            'royalties_percentage' => $request->royalties_percentage,
            'total_fractions' => $request->total_fractions,
            'sold_fractions' => ($request->ownership_percentage / 100) * $request->total_fractions,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'category_id' => $request->category_id,
            'creator_id' => $request->creator_id,
            'artist_id' => $request->artist_id,
            'creation' => $request->creation,
            'size' => $request->size,
            'material' => $request->material,
            'order' => $request->order,
        ]);
        return redirect()->route('upload.page', ['type' => Asset::class, 'id' => $asset->id, 'edit' => 0]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset = Asset::with(['medias', 'videos', 'videoLinks'])->find($id);
        return view('admin.asset.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $galleries = Gallery::all();
        $artists = Artist::all();
        $asset = Asset::query()->find($id);

        $minteds = [];
        foreach ($asset->contracts as $contract) {
            array_push($minteds, $contract->minted);
        }

        $isMinted = false;
        if (count($minteds) > 0) {
            $isMinted = !in_array(null, $minteds);
        }

        return view('admin.asset.edit', compact('categories', 'galleries', 'artists', 'asset', 'isMinted'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $asset = Asset::query()->findOrFail($id);
        $minteds = [];
        foreach ($asset->contracts as $contract) {
            $minteds[] = $contract->minted;
        }

        $isMinted = false;
        if (count($minteds) > 0) {
            $isMinted = !in_array(null, $minteds);
        }

        if ($isMinted) {
            $validation = $request->validate([
                'total_fractions' => 'numeric',
                'end_date' => 'date|nullable|after_or_equal:start_date',
                'start_date' => 'date|nullable',
                'creator_id' => 'required',
                'artist_id' => 'required',
                'category_id' => 'required',
                'creation' => 'nullable',
                'order' => 'regex:/^([0-4]{1})$/|nullable|unique:assets,order,' . $asset,
            ]);
        } else {
            $validation = $request->validate([
                'title' => 'required|min:3',
                'price' => 'required',
                'bio' => 'required|max:1024',
                'ownership_percentage' => 'required|numeric',
                'royalties_percentage' => 'required|numeric',
                'total_fractions' => 'numeric',
                'end_date' => 'date|nullable|after_or_equal:start_date',
                'start_date' => 'date|nullable',
                'creator_id' => 'required',
                'artist_id' => 'required',
                'category_id' => 'required',
                'creation' => 'nullable',
                'order' => 'regex:/^([0-4]{1})$/|nullable|unique:assets,order,' . $asset,
            ]);
        }

        if(!$isMinted)
        {
            $asset->title = $request->title;
            $asset->bio = $request->bio;
            $asset->price = $request->price;
            $asset->ownership_percentage = $request->ownership_percentage;
            $asset->royalties_percentage = $request->royalties_percentage;
        }
        $asset->total_fractions = $request->total_fractions;
        $asset->sold_fractions = ($request->ownership_percentage / 100) * $request->total_fractions;
        $asset->start_date = $request->start_date;
        $asset->end_date = $request->end_date;
        $asset->category_id = $request->category_id;
        $asset->creator_id = $request->creator_id;
        $asset->artist_id = $request->artist_id;
        $asset->creation = $request->creation;
        $asset->size = $request->size;
        $asset->material = $request->material;
        $asset->order = $request->order;
        $asset->save();

        return redirect()->back()->with(['success' => 'true', 'title' => 'Asset Saved successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $assets = Asset::find($id);
        $assets->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }

    public function changeStatus(Request $request, Asset $asset)
    {
        $minteds = [];

        if ($request->status == 'published') {
            $medias = $asset->medias;
            $tmp = [];
            $flag = false;
            foreach ($medias as $media) {
                if ($media->main == 1) {
                    $tmp[] = true;
                }
            }
            if (count($tmp) > 1 or count($tmp) < 1) {
                return redirect()->back()->with(['message' => 'publishing this asset is not possible. please upload a main media for the asset']);
            }
        }

        foreach ($asset->contracts as $contract) {
            array_push($minteds, $contract->minted);
        }
        if ($asset->status == 'unpublished') {
            if (count($minteds) == 0 || in_array(null, $minteds)) {
                return redirect()->back()->with(['message' => 'Asset has not been minted', 'icon' => 'error']);
            }
        }
        $asset->status = $request->status;
        $asset->save();

        return redirect()->back();
    }
}
