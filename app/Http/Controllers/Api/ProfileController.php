<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|string',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,svg|max:4096'
        ]);
        $avatar = $request->file('avatar');
        $uploadFolder = 'media/' . $avatar->getClientMimeType();
        $path = $avatar->store($uploadFolder);


        $user = showUserService::getUser($address);
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->avatar = $path;
        $user->save();

    }
}
