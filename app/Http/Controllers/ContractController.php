<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\contract\storeContract;
use App\Models\Artist;
use App\Models\Asset;
use App\Models\Contract;
use App\Models\Media;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function index($asset_id)
    {
        $NFTpath = resource_path() . "/artifacts/contracts/NFT.sol/NFT.json";
        $NFTjson = json_decode(file_get_contents($NFTpath), true);
        $NFTabi = $NFTjson['abi'];
        $MarketPath = resource_path() . "/artifacts/contracts/Market.sol/NFTMarket.json";
        $MarketJson = json_decode(file_get_contents($MarketPath), true);
        $MarketAbi = $MarketJson['abi'];
        $contracts = Contract::query()->where('asset_id', $asset_id)->orderBy("created_at", "desc")->get();
        $asset = Asset::find($asset_id);
        return view('admin.contract.index', compact('contracts', 'asset_id', 'asset', 'NFTabi', 'MarketAbi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create($asset_id)
    {
        return view('admin.contract.create', compact('asset_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(storeContract $request)
    {
        $contract = Contract::query()->create([
            'hash' => null,
            'contract_number' => $request->contract_number,
            'asset_id' => $request->asset_id
        ]);


        return redirect()->route('upload.page', ['type' => Contract::class, 'id' => $contract->id,'edit'=>0]);

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $contracts = Contract::find($id);
        $contracts->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = time() . '.' . $file->extension();
        $uploadFolder = 'file';
        $file->store($uploadFolder, 'public');
        $media = Media::query()->create([
            'ipfs_hash' => 'NOTHING',
            'mime_type' => $file->getClientMimeType(),
            'path' => $file->path(),
            'mediable_type' => Contract::class,
            'mediable_id' => 500000

        ]);

        return response()->json([
            'success' => $fileName,
            'media_id' => $media->id
        ]);
    }
}
