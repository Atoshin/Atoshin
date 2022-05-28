<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class CropController extends Controller
{
    public function cropPage()
    {
        return view('admin.media.crop');
    }

    public function download(Request $request)
    {
        $image = $request->image;
        return \response()->download($image);
    }
}
