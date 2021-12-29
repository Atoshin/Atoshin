<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Asset;
use App\Models\Contract;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function uploadFile(Request $request, $mediable_type, $mediable_id)
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
                'mediable_id' => $mediable_id

            ]);
        } elseif ($mediable_type == Contract::class) {
            $response = Http::attach(
                'attachment', file_get_contents($request->file('file')), $fileName
            )->post('https://ipfs.infura.io:5001/api/v0/add');
            $contract = Contract::query()->find($mediable_id);
            $contract->hash = $response->json()['Hash'];
            $contract->save();
            Media::query()->create([
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

    public function deleteMain($type, $id)
    {

        $media = Media::where('mediable_type', $type)->where('mediable_id', $id)->where('main', true)->first();
        Storage::delete(\asset(substr($media->path, 13, 50)));
        $media->delete();
        return Response()->json([
            'message' => 'deleted_successfully',
            'type' => $type,
            'id' => $id
        ]);
    }

    public function delete($type, $id)
    {
        $media = Media::where('mediable_type', $type)->where('mediable_id', $id)->first();
        Storage::delete(\asset(substr($media->path, 13, 50)));
        $media->delete();
        return Response()->json([
            'message' => 'deleted_successfully',
            'type' => $type,
            'id' => $id
        ]);
    }

    public function index($type, $id)
    {
        $medias = Media::query()->where('mediable_type', $type)->where('mediable_id', $id)->get();
        return view('admin.media.index', compact('medias'));

    }

    public function homepage($id)
    {
        $media = Media::query()->find($id);

        if ($media->homeapage_picture == true) {
            $media->homeapage_picture = false;
        } else {
            $media->homeapage_picture = true;
        }
        $media->save();
        return redirect()->back();
    }


}
