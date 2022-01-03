<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShowUser\showUserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user= showUserService::getUser($id);
        return response()->json([
            'message'=>'user retrieved successfully',
            'user'=>$user
        ]);
    }
}
