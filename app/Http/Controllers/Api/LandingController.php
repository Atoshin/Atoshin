<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Landing;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function getLandingContent()
    {
        $landing = Landing::query()->findOrFail(1);
        return response()->json([
            'message' => 'content retrieved successfully',
            'data' => $landing->text
        ]);
    }
}
