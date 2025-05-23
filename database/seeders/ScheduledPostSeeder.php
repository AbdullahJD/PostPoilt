<?php

namespace Database\Seeders;

use App\Models\Platform;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ScheduledPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'abd@gmail.com'],
            [
                'name' => 'abd',
                'password' => Hash::make('123123'),
            ]
        );
        
        $platforms = [
            Platform::firstOrCreate(['type' => 'twitter'], ['name' => 'Twitter']),
            Platform::firstOrCreate(['type' => 'instagram'], ['name' => 'Instagram']),
            Platform::firstOrCreate(['type' => 'linkedin'], ['name' => 'LinkedIn']),
        ];

        $post = Post::create([
            'title' => 'Scheduled Seeder Post',
            'content' => 'This is a seeded post for testing.',
            'status' => 'scheduled',
            'scheduled_time' => now()->subMinutes(1),
            'user_id' => $user->id,
        ]);

        foreach ($platforms as $platform) {
            $post->platforms()->attach($platform->id, ['platform_status' => 'pending']);
        }

        $this->command->info('Abd, platform, and scheduled post created successfully.');
    }
}
