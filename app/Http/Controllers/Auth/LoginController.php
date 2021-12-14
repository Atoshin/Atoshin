<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    public function loginPage()
    {
        if(View::exists('admin.auth.login'))
        {
            return view('admin.auth.login');
        }
    }

    public function login(Request $request)
    {
        $creds = $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($creds)){
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');

        }

        return redirect()->back();

    }

    public function logoutAdmin()
    {
        $admin = Auth::guard('admin')->user();

        Auth::guard('admin')->logout();

        return redirect()->route('login.page');
    }

}
