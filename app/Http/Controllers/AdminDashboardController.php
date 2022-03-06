<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Asset;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function adminDashboard()
    {
        $galleries_count = Gallery::query()->count();
        $artists_count = Artist::query()->count();
        $assets_count = Asset::query()->count();
        $users_count = User::query()->count();



        return view('admin.dashboard',compact(['galleries_count','artists_count','assets_count','users_count']));
    }
}
