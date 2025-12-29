<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Admin;
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
        $admin = Admin::query()->where('username',$request->username)->first();
//        if($admin->blocked)
//        {
//            return redirect()->back()->with('message','You are blocked!');
//        }

        if (Auth::guard('admin')->attempt($creds)){

            $admin = Auth::guard('admin')->getProvider()->retrieveByCredentials($creds);
            Auth::guard('admin')->login($admin, $request->get('remember'));

            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');

        }

        return redirect()->back()->with('message','invalid username or password');

    }

    public function logoutAdmin()
    {
        $admin = Auth::guard('admin')->user();

        Auth::guard('admin')->logout();

        return redirect()->route('login.page');
    }

}
