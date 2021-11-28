<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = User:: all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::query()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'avatar' => $request->avatar,
                'email' => $request->email,
                'username' => $request->username,
                'bio' => $request->bio,
            ]);
            Wallet::query()->create([
                'wallet_address' => $request->wallet_address,
                'user_id' => $user->id
            ]);
        });
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $wallet = $user->wallet;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->avatar = $request->avatar;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->bio = $request->bio;
        $user->save();
        if ($wallet) {
            $wallet->wallet_address = $request->wallet_address;
        } else {
            Wallet::query()->create([
                'wallet_address' => $request->wallet_address,
                'user_id' => $user->id
            ]);
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }

}
