<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = collect(['Purok Casia', 'Urgent', 'Libre', 'Schedule', 'Community'])
            ->mapWithKeys(fn (string $name) => [$name => Tag::create(['name' => $name])]);

        Post::query()->each(function (Post $post) use ($tags): void {
            $post->tags()->sync($tags->random(random_int(1, 3))->pluck('id'));
        });

        $pinned = Post::where('is_pinned', true)->firstOrFail();
        $pinned->tags()->sync([$tags['Purok Casia']->id, $tags['Urgent']->id]);
    }
}
