<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Services\ShowUser\showUserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($address): \Illuminate\Http\JsonResponse
    {
        $user = showUserService::getUser($address);
        return response()->json([
            'message' => 'user retrieved successfully',
            'user' => $user
        ]);
    }


    public function update(Request $request, $address)
    {
        $request->validate([
            'firstName' => 'nullable|string',
            'lastName' => 'nullable|string',
            'email' => 'nullable|email|string',
            'avatar' => 'nullable|string'
        ]);
        $user = $wallet = Wallet::query()->where('wallet_address', $address)->first();
        $user = User::query()->find($wallet->walletable_id);
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->avatar = $request->avatar;
        $user->save();

    }
}
