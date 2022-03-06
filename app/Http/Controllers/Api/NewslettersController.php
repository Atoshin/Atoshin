<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use App\Models\Signature;
use Illuminate\Http\Request;

class NewslettersController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:newsletter,email'
        ]);
        $token = $request->header('Authorization');
        if ($token) {
            $token = Signature::query()->where('hash', $token)->first();
            if ($token) {
                $user = $token->user;
                $user->email = $request->email;
                $user->save();
            } else {
                return response()->json([
                    'message' => 'invalid token'
                ], 429);
            }
        }
        NewsLetter::query()->create([
            'email' => $request->email
        ]);
        return response()->json([
            'message' => 'submitted successfully'
        ]);
    }
}
