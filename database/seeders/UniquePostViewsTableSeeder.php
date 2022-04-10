<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;
use App\Models\User;


class UniquePostViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first_post = Post::find(1);
        $first_post->users_viewed_by()->attach(
            User::all()->except($first_post->user->id)
                ->pluck('id')->toArray()
        );
        // first post was viewed by everyone
        // but the creator itself doesn't count
        
        $posts_except_first = Post::all()->except(1);
        $users = User::all();
        $user_count = User::count();
        
        foreach ($posts_except_first as $post) {
            // all the other posts were viewed by a random amount of people
            // but the creator itself is still excluded
            $post->users_viewed_by()->attach(
                $users->except($post->user->id)->random(rand(0, $user_count-1))
                    ->pluck('id')->toArray()
            );
        }
    }
}
