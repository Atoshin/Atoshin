<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function adminDashboard()
    {
        $galleries_count = Gallery::query()->count();

        return view('admin.dashboard',compact('galleries_count'));
    }
}
