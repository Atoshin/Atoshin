<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Gallerying;
use App\Models\Location;
use App\Models\Media;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryRegisterController extends Controller
{
    public function registerPage()
    {
        return view('admin.gallery.register');
    }

    public function register(Request $request)
    {
        $validator = $request->validate([
            'name'=>'required',
            'bio'=>'nullable|max:3000',
            'title'=>'required',
            'full_name'=>'required',
            'rep_telephone'=>'required'
        ]);

        DB::transaction(function () use ($request, &$gallery){
            $gallery = Gallery::query()->create([
                'name' => $request->name,
                'bio' => $request->bio,
                'website' => $request->website,
                'status' => 'unpublished',
            ]);

            $location = Location::query()->create([
                'gallery_id' => $gallery->id,
                'address' => $request->address,
                'lat'=> 12.1235,
                'long'=>13.12154,
                'telephone' => $request->telephone,
            ]);

            $manager = Gallerying::query()->create([
                'gallery_id'=>$gallery->id,
                'full_name' => $request->full_name,
                'title' => $request->title,
                'email' => $request->rep_email,
                'telephone' => $request->rep_telephone,
                'is_owner' => $request->is_owner == 'on' ? true : false
            ]);


            if($request->hasFile('file'))
            {
                $file = $request->file('file');
                $fileName = time().'.'.$file->extension();
                $uploadFolder = 'file';
                $path = $file->store($uploadFolder, 'public');

                $media = Media::query()->create([
                    'ipfs_hash'=>'NOTHING',
                    'mime_type'=>$file->getClientMimeType(),
                    'path'=> 'storage/' . $path,
                    'mediable_type'=>Gallery::class,
                    'mediable_id'=> $gallery->id,
                    'main'=>false

                ]);
            }


        });

        return redirect()->route('gallery.register.success');



    }

    public function successPage()
    {
        return view('admin.gallery.success');
    }
}
