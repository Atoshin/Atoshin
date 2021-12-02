<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Asset;
use App\Models\Gallery;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function upload($type,$id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,mp3,mp4,avi,webm,mkv|max:8192'
        ]);
        if ($validator->fails()) {

            return response()->json([
                'message' => $validator->messages()->first()
            ], 500);
        }
        $file = $request->file('file');
        $uploadFolder = 'media/' . $file->getClientMimeType();
        $file_uploaded_path = $file->store($uploadFolder, 'public');
        $path = $file->store($uploadFolder);
        if($type== 'asset')
        {
            Media::query()->create([
                "ipfs_hash" => 'nothing_important',
                "path" => $path,
                "mime_type" => $file->getClientMimeType(),
                "mediaable_type"=>Asset::class,
                "mediable_id" => $id

            ]);
        }
        else if($type== 'artist')
        {
            Media::query()->create([
                "ipfs_hash" => 'nothing_important',
                "path" => $path,
                "mime_type" => $file->getClientMimeType(),
                "mediaable_type"=>Artist::class,
                "mediable_id" => $id

            ]);
        }
        else
        {
            Media::query()->create([
                "ipfs_hash" => 'nothing_important',
                "path" => $path,
                "mime_type" => $file->getClientMimeType(),
                "mediaable_type"=>Gallery::class,
                "mediable_id" => $id

            ]);
        }

        $uploadedFileResponse = array(
            "file_name" => $file->getClientOriginalName(),
            "file_url" => Storage::disk('public')->url($file_uploaded_path),
            "mime" => $file->getClientMimeType()
        );

        return response()->json([
            'message' => 'File Uploaded Successfully',
            'response' => $uploadedFileResponse
        ], 200);

    }
}
