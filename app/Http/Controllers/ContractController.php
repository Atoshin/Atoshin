<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\contract\storeContract;
use App\Models\Artist;
use App\Models\Asset;
use App\Models\Contract;
use App\Models\Media;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($asset_id)
    {
        $contracts = Contract::query()->where('asset_id',$asset_id)->orderBy("created_at","desc")->get();
        $asset = Asset::find($asset_id);
        return view('admin.contract.index',['contracts' => $contracts,'asset_id'=>$asset_id,'asset'=>$asset]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create($asset_id)
    {
        return view('admin.contract.create',compact('asset_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(storeContract $request)
    {
        $contract = Contract::query()->create([
            'hash'=>'nothing',
            'contract_number'=>$request->contract_number,
            'asset_id'=>$request->asset_id
        ]);


        return redirect()->route('upload.page',['type'=>Contract::class,'id'=>$contract->id]);

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = time().'.'.$file->extension();
        $uploadFolder = 'file';
        $file->store($uploadFolder, 'public');
        $media = Media::query()->create([
            'ipfs_hash'=>'NOTHING',
            'mime_type'=>$file->getClientMimeType(),
            'path'=>$file->path(),
            'mediable_type'=>Contract::class,
            'mediable_id'=> 500000

        ]);

        return response()->json([
            'success'=>$fileName,
            'media_id'=>$media->id
        ]);
    }
}
