<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first = new Post();
        $first->title = "Welcome!";
        $first->message = "Welcome to my Web App. I hope you like it.";
        $first->public = true;
        $first->user_id = 1;
        $first->save();

        Post::factory()->count(80)->create();
    }
}
