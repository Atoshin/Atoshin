<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Asset;
use App\Models\Auction;
use App\Models\Contract;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{

    public function uploadFile(Request $request,$mediable_type,$mediable_id)
    {

        if(!$request->has('file'))
        {
            return response()->json([
                'error' => 'missing_file'
            ]);
        }
        if($mediable_type == User::class)
        {
            $medias = Media::query()->where('mediable_type',User::class)->where('mediable_id',$mediable_id)->get();
            if($medias)
            {
                foreach ($medias as $media)
                {
                    $media->delete();
                }
            }
        }


        $large_flag = false;
        $file = $request->file('file');
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');
        $height = Image::make($file)->height();
        $width = Image::make($file)->width();







            $media = Media::query()->create([
                'ipfs_hash' => 'NOTHING',
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,
                'width' => $width,
                'height' => $height,
                'gallery_large_picture' => $large_flag

            ]);


            return response()->json([
                'media' => $media
            ]);

    }
}
