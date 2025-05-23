<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function edit()
    {
        $platforms = Platform::all(); // جميع المنصات
        return view('dashboard.settings.platforms', compact('platforms'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'platforms' => 'nullable|array',
            'platforms.*' => 'exists:platforms,id'
        ]);

        // ربط المستخدم بالمنصات المختارة فقط
        auth()->user()->platforms()->sync($request->platforms ?? []);

        // dd($request->platforms);


        return redirect()->back()->with('success', 'Platforms updated successfully!');
    }
}
