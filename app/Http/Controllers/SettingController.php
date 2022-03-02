<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function setting()
    {
//        $galleries_count = Gallery::query()->count();
//        $artists_count = Artist::query()->count();
//        $assets_count = Asset::query()->count();
//        $users_count = User::query()->count();


        return view('admin.setting');
    }
}
