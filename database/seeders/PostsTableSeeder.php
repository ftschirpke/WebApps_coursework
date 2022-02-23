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
        $first->message = "Welcome to my Web App. I hope you like it.";
        $first->public = true;
        $first->save();

        Post::factory()->count(100)->create();
    }
}
