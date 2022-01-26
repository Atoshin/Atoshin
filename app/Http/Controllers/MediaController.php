<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Asset;
use App\Models\Contract;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\User;
use App\Models\VideoLink;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function uploadFile(Request $request, $mediable_type, $mediable_id)
    {
        if ($mediable_type == Contract::class) {
            $request->validate([
                'file' => 'required'
            ]);
        }
        $file = $request->file('file');
        $fileName = time() . '.' . $file->extension();
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');

//        $path = Storage::putFile('public/' . $path, $request->file('file'));
        if ($mediable_type == Contract::class) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('file')), $fileName
            )->post('https://ipfs.infura.io:5001/api/v0/add');
            $media = Media::query()->create([
                'ipfs_hash' => $response->json()['Hash'],
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id
            ]);

            return redirect()->back();
        } elseif ($mediable_type == Asset::class) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('file')), $fileName
            )->post('https://ipfs.infura.io:5001/api/v0/add');
            $media = Media::query()->create([
                'ipfs_hash' => $response->json()['Hash'],
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id

            ]);
        } else {

            $media = Media::query()->create([
                'ipfs_hash' => 'NOTHING',
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id

            ]);

        }


        $entity = $mediable_type::query()->find($mediable_id);
        $homepage_medias = $entity->medias()->where('main', false)->where('homeapage_picture', true)->get();
        $not_homepage_medias = $entity->medias()->where('main', false)->where('homeapage_picture', false)->get();
        if (count($homepage_medias) < 4) {
            $counter = 4 - count($homepage_medias);
            foreach ($not_homepage_medias as $media) {
                while ($counter <= 4) {
                    $media->homeapage_picture = true;
                    $media->save();
                    $counter++;
                }

            }
        }


        return redirect()->back();
    }

    public function uploadPage($type, $id)
    {
//        $media = Media::query()->where('mediable_type',$type)->where('mediable_id',$id)->get();
        return view('admin.media.upload', compact('type', 'id'));
    }

    public function destroy($id)
    {
        $artist = Artist::find($id);
        $artist->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }

    public function uploadPageMain($type, $id)
    {
        return view('admin.media.upload-main', compact('type', 'id'));
    }

    public function uploadMainFile(Request $request, $mediable_type, $mediable_id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);
        $file = $request->file('file');
        $fileName = time() . '.' . $file->extension();
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');

//        $path = Storage::putFile('public/' . $path, $request->file('file'));
        if ($mediable_type == Asset::class) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('file')), $fileName
            )->post('https://ipfs.infura.io:5001/api/v0/add');
            $media = Media::query()->create([
                'ipfs_hash' => $response->json()['Hash'],
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,
                'main' => true

            ]);

        } else {

            $media = Media::query()->create([
                'ipfs_hash' => 'NOTHING',
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,
                'main' => true

            ]);

        }
        return response()->json([
            'message' => 'File Uploaded Successfully',
        ], 200);

    }

    public function uploadFileEdit(Request $request, $mediable_type, $mediable_id)
    {

        $file = $request->file('file');
        $fileName = time() . '.' . $file->extension();
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');

//        $path = Storage::putFile('public/' . $path, $request->file('file'));
        if ($mediable_type == Asset::class) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('file')), $fileName
            )->post('https://ipfs.infura.io:5001/api/v0/add');
            $media = Media::query()->create([
                'ipfs_hash' => $response->json()['Hash'],
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,


            ]);

        } else {

            $media = Media::query()->create([
                'ipfs_hash' => 'NOTHING',
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,


            ]);

        }

        $entity = $mediable_type::query()->find($mediable_id);
        $homepage_medias = $entity->medias()->where('main', false)->where('homeapage_picture', true)->get();
        $not_homepage_medias = $entity->medias()->where('main', false)->where('homeapage_picture', false)->get();
        if (count($homepage_medias) < 4) {
            $counter = 4 - count($homepage_medias);
            foreach ($not_homepage_medias as $media) {
                while ($counter <= 4) {
                    $media->homeapage_picture = true;
                    $media->save();
                    $counter++;
                }

            }
        }


        return response()->json([
            'message' => 'File Uploaded Successfully',
        ], 200);
    }

    public function uploadEditPage($type, $id)
    {
        if ($type == User::class) {
            $entity = $type::query()->with('media')->where('id', $id)->first();
            return view('admin.media.upload-edit', compact('type', 'id', 'entity'));
        } else {
            $entity = $type::query()->with('medias')->where('id', $id)->first();

            return view('admin.media.upload-edit', compact('type', 'id', 'entity'));
        }

    }

    public function uploadMainFileEdit(Request $request, $mediable_type, $mediable_id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);
        $file = $request->file('file');
        $fileName = time() . '.' . $file->extension();
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');

//        $path = Storage::putFile('public/' . $path, $request->file('file'));
        if ($mediable_type == Asset::class) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('file')), $fileName
            )->post('https://ipfs.infura.io:5001/api/v0/add');
            $media = Media::query()->create([
                'ipfs_hash' => $response->json()['Hash'],
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,
                'main' => true

            ]);

        } else {

            $media = Media::query()->create([
                'ipfs_hash' => 'NOTHING',
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,
                'main' => true
            ]);

        }

        return redirect()->back();
    }

    public function uploadEditPageMain($type, $id)
    {

        if ($type == User::class) {
            $entity = $type::query()->with('media')->where('id', $id)->first();

            return view('admin.media.upload-main-edit', compact('type', 'id', 'entity'));
        } else {
            $entity = $type::query()->with('medias')->where('id', $id)->first();
            return view('admin.media.upload-main-edit', compact('type', 'id', 'entity'));
        }

    }

    public function deleteMain($media_id)
    {

        $media = Media::where('id', $media_id)->where('main', true)->first();
        Storage::delete(\asset(substr($media->path, 13, 50)));
        $media->delete();
        return Response()->json([
            'message' => 'deleted_successfully',
        ]);
    }

    public function delete($media_id)
    {
        $media = Media::find($media_id);
        Storage::delete(\asset(substr($media->path, 13, 50)));
        $media->delete();
        return Response()->json([
            'message' => 'deleted_successfully',

        ]);
    }

    public function index($type, $id)
    {
        $medias = Media::query()->where('mediable_type', $type)->where('mediable_id', $id)->where('main', false)->get();
        return view('admin.media.index', compact('medias'));

    }

    public function homepage($id)
    {
        $media = Media::query()->find($id);

        if ($media->homeapage_picture == true) {
            $homepage_medias = Media::query()->where('main', false)->where('mediable_type', $media->mediable_type)
                ->where('mediable_id', $media->mediable_id)->where('homeapage_picture', true)->get();
            if (count($homepage_medias) <= 4) {
//                \request()->session()->flash('message', 'please choose another photo for homepage before removing this media from the homepage');
                return redirect()->back()->with(['message' => 'please choose another media for homepage before removing this media from the homepage', 'icon' => 'warning']);
            }
            $media->homeapage_picture = false;
        } else {
            $media->homeapage_picture = true;
        }
        $media->save();
        return redirect()->back();
    }

    public function galleryLargePictureUploadPage($gallery_id)
    {
        return view('admin.media.upload-gallery-large-picture',compact('gallery_id'));
    }

    public function uploadGalleryLargePicture(Request $request,$gallery_id)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);
        $file = $request->file('file');
        $fileName = time() . '.' . $file->extension();
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');

        $media = Media::query()->create([
                'ipfs_hash' => 'nothing',
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => Gallery::class,
                'mediable_id' => $gallery_id,
                'gallery_large_picture' => true

            ]);


        return response()->json([
            'message' => 'File Uploaded Successfully',
        ], 200);
    }

    public function uploadvideoFile(Request $request, $mediable_type, $mediable_id,$gallery_id)
    {
        $gallery=Gallery::find($gallery_id);
        $video_link = VideoLink::query()->where('video_linkable_id',$gallery_id)->where('video_linkable_type',Gallery::class)->where('is_default',true)->first();

        if ($video_link->media)
        {
            Storage::delete(\asset(substr($video_link->media->path, 13, 50)));
            $video_link->media->delete();
        }

        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);
        $file = $request->file('file');
        $fileName = time() . '.' . $file->extension();
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');

//        $path = Storage::putFile('public/' . $path, $request->file('file'));

            $media = Media::query()->create([
                'ipfs_hash' =>'nothing',
                'mime_type' => $file->getClientMimeType(),
                'path' => 'storage/' . $path,
                'mediable_type' => $mediable_type,
                'mediable_id' => $mediable_id,
                'main' => false,
                'video' => true

            ]);

        return response()->json([
            'message' => 'File Uploaded Successfully',
        ], 200);
    }

    public function uploadvideoPage($type,$id,$gallery_id)
    {
        return view('admin.media.upload-video', compact('type', 'id','gallery_id'));
    }

    public function galleryLargePictureEditUploadPage($gallery_id)
    {
        $gallery = Gallery::find($gallery_id);
        return view('admin.media.upload-gallery-large-picture-edit',compact('gallery_id','gallery'));
    }

    public function uploadGalleryLargePictureEdit(Request $request,$gallery_id)
    {
        $gallery=Gallery::find($gallery_id);
        $large = $gallery->medias->where('gallery_large_picture',true)->first();
        if ($large)
        {
            Storage::delete(\asset(substr($large->path, 13, 50)));
            $large->delete();
        }

        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);
        $file = $request->file('file');
        $fileName = time() . '.' . $file->extension();
        $uploadFolder = 'file';
        $path = $file->store($uploadFolder, 'public');

//        $path = Storage::putFile('public/' . $path, $request->file('file'));

        $media = Media::query()->create([
            'ipfs_hash' =>'nothing',
            'mime_type' => $file->getClientMimeType(),
            'path' => 'storage/' . $path,
            'mediable_type' => Gallery::class,
            'mediable_id' => $gallery_id,
            'main' => false,
            'video' => false,
            'gallery_large_picture'=>true

        ]);

        return response()->json([
            'message' => 'File Uploaded Successfully',
        ], 200);
    }


}
