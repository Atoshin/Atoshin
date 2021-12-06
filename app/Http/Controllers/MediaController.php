<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Contract;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function uploadFile(Request $request,$mediable_type,$mediable_id)
    {

        $file = $request->file('file');
        $fileName = time().'.'.$file->extension();
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');

//        $path = Storage::putFile('public/' . $path, $request->file('file'));



        if($mediable_type == Asset::class)
        {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('file')), $fileName
            )->post('https://ipfs.infura.io:5001/api/v0/add');
            $media = Media::query()->create([
                'ipfs_hash'=>$response->json()['Hash'],
                'mime_type'=>$file->getClientMimeType(),
                'path'=> 'storage/' . $path,
                'mediable_type'=>$mediable_type,
                'mediable_id'=> $mediable_id

            ]);
        }
        else
        {
            $media = Media::query()->create([
                'ipfs_hash'=>'NOTHING',
                'mime_type'=>$file->getClientMimeType(),
                'path'=> 'storage/' . $path,
                'mediable_type'=>$mediable_type,
                'mediable_id'=> $mediable_id

            ]);
        }


        return response()->json([
            'success'=>$fileName,
            'media_id'=>$media->id
        ]);
    }

    public function uploadPage($type,$id)
    {
        return view('admin.media.upload',compact('type','id'));
    }
}
