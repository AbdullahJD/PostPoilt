<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index()
    {
        return response()->json(Platform::all());
    }

    public function updateUserPlatforms(Request $request)
    {
        $request->validate([
            'platforms' => 'nullable|array',
            'platforms.*' => 'exists:platforms,id'
        ]);

        $request->user()->platforms()->sync($request->platforms ?? []);

        return response()->json(['message' => 'User platforms updated successfully']);
    }
}
