<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;
use App\Models\User;

class UniquePostViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first_post = Post::find(1);
        $first_post->viewed_by()->attach(User::all()->except($first_post->user->id));
        // first post was viewed by everyone
        // but the creator itself doesn't count

        $factory_created_posts = Post::all()->except(1);
        $users = User::all();
        $user_count = User::count();

        foreach ($factory_created_posts as $post) {
            // all the other posts were viewed by a random amount of people
            $post->viewed_by()->attach(
                $users->except($post->user->id)->random(rand(0, $user_count-1))
            );
        }
    }
}
