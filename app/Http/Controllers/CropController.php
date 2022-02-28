<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CropController extends Controller
{
    public function cropPage()
    {
        return view('admin.media.crop');
    }
}
