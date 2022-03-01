<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first = new Comment();
        $first->message = "Hello!";
        $first->user_id = 2;
        $first->post_id = 1;
        $first->save();

        Comment::factory()->count(170)->create();
    }
}
