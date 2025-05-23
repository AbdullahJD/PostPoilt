<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function create()
    {
        $platforms = auth()->user()->platforms; // فقط المنصات المرتبطة بالمستخدم
        return view('dashboard.post', compact('platforms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'scheduled_time' => 'required|date',
            'platforms' => 'required|array',
            'platforms.*' => 'in:twitter,instagram,linkedin',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // رفع الصورة إن وُجدت
        $imageName  = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName, 'public');
        }

        // إنشاء المنشور
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'scheduled_time' => $request->scheduled_time,
            'status' => 'scheduled',
            'user_id' => auth()->id(),
        ]);

        // ربط المنشور بالمنصات
        foreach ($request->platforms as $platformType) {
            $platform = Platform::where('type', $platformType)->first();
            if ($platform) {
                $post->platforms()->attach($platform->id, ['platform_status' => 'pending']);
            }
        }

        return redirect('/dashboard')->with('success', 'Post scheduled successfully!');
    }
}
