<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        Post::where('is_published', true)->each(function (Post $post) use ($users): void {
            Comment::factory()->count(random_int(0, 5))->create([
                'post_id' => $post->id,
                'user_id' => $users->random()->id,
            ]);
        });

        $pinned = Post::where('is_pinned', true)->firstOrFail();
        $lola = User::where('email', 'lola.casia@bulletin.test')->firstOrFail();
        $pinned->comments()->createMany([
            ['user_id' => $lola->id, 'body' => 'Thank you for sharing this announcement, Kapitan.'],
            ['user_id' => $users->random()->id, 'body' => 'I will join the clean-up drive.'],
            ['user_id' => $users->random()->id, 'body' => 'See you there, everyone.'],
        ]);
    }
}
