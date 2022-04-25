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
        $fileName = time() . '.' . $file->extension();
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');
        $height = Image::make($file)->height();
        $width = Image::make($file)->width();

        if ($mediable_type == User::class or $mediable_type == Auction::class or $mediable_type == Contract::class) {
            $medias = Media::query()->where('mediable_type', $mediable_type)->where('mediable_id', $mediable_id)->get();

            if (count($medias) > 0) {
                return response()->json([
                    'error' => 'exceeded_media_number_limit'
                ]);
            }
        }



        if ($mediable_type != User::class and $mediable_type != Auction::class and $mediable_type != Contract::class and $mediable_type!= Asset::class) {
            if ( floor($width/$height*100)/100 != 3/2  ) {
                if ($width != '1120' && $height != '460') {
                    return response()->json([
                        'error' => 'size_error',
                        'height'=> $height,
                        'width'=>$width,
                    ]);
                }

            }
        }


        if ($mediable_type == Contract::class) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('file')), $fileName
            )->post('https://ipfs.infura.io:5001/api/v0/add');
            $media = Media::query()->create([
                'ipfs_hash' => $response->json()['Hash'],
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,
                'width' => $width,
                'height' => $height,
            ]);


        } elseif ($mediable_type == Asset::class) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('file')), $fileName
            )->post('https://ipfs.infura.io:5001/api/v0/add');
            $media = Media::query()->create([
                'ipfs_hash' => $response->json()['Hash'],
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,
                'width' => $width,
                'height' => $height


            ]);
        } else {

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

            if($media->width == 1120 && $media->height == 460)
            {
                $this->makeLarge($media->id);
                $large_flag = true;
            }


        }

        $medias = Media::query()->where('mediable_type', $mediable_type)->where('mediable_id', $mediable_id)->get();
        if($mediable_type == Gallery::class)
        {
            return response()->json([
                'medias' => $medias,
                'large_flag'=> $large_flag
            ]);
        } else {
            return response()->json([
                'medias' => $medias
            ]);
        }
    }
}
