<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('platforms')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'scheduled_time' => 'required|date',
            'platforms' => 'required|array',
        ]);

        $post = Post::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'scheduled_time' => $request->scheduled_time,
            'status' => 'scheduled'
        ]);

        foreach ($request->platforms as $platformType) {
            $platform = Platform::where('type', $platformType)->first();
            if ($platform) {
                $post->platforms()->attach($platform->id, ['platform_status' => 'pending']);
            }
        }

        return response()->json(['message' => 'Post scheduled successfully']);
    }

    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();

        $post->update($request->only(['title', 'content', 'scheduled_time']));

        return response()->json(['message' => 'Post updated successfully']);
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}
