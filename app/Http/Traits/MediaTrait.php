<?php

namespace App\Http\Traits;


use App\Models\Gallery;
use App\Models\Media;

trait MediaTrait {

    public function upload($request,$mediable_type,$mediable_id) {

        $file = $request->file('file');
        $fileName = time().'.'.$file->extension();
        $uploadFolder = 'file';
        $file->store($uploadFolder, 'public');

        $media = Media::query()->create([
            'ipfs_hash'=>'NOTHING',
            'mime_type'=>$file->getClientMimeType(),
            'path'=>$file->path(),
            'mediable_type'=>$mediable_type,
            'mediable_id'=> $mediable_id
        ]);
    }
}
