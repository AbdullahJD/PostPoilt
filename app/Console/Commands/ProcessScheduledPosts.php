<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessScheduledPosts extends Command
{
    protected $signature = 'posts:process-scheduled';
    protected $description = 'Publish scheduled posts whose time has come';

    public function handle()
    {
        $now = Carbon::now();

        $posts = Post::where('status', 'scheduled')
                    ->where('scheduled_time', '<=', $now)
                    ->get();

        foreach ($posts as $post) {
            // نشر تجريبي (mock)
            foreach ($post->platforms as $platform) {
                $post->platforms()->updateExistingPivot($platform->id, [
                    'platform_status' => 'success' // أو random success/failed
                ]);
            }

            $post->status = 'published';
            $post->save();

            $this->info("Published Post ID: {$post->id}");
        }

        return 0;
    }
}