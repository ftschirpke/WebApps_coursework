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
        // seeding a lot of small comments on a single post
        $comment_messages = array("This", "post", "has", "a", "lot", "of", "comments", "but", "why?");
        foreach ($comment_messages as $msg) {
            $comment = new Comment();
            $comment->message = $msg;
            $comment->user_id = 2;
            $comment->post_id = 1;
            $comment->save();
        }

        $comment = new Comment();
        $comment->message = "Little Red Riding Hood is boring...";
        $comment->user_id = 1;
        $comment->post_id = 2;
        $comment->save();

        // seeding a comment on a user's own post
        $comment = new Comment();
        $comment->message = "I like Little Red Riding Hood. \u{1F600}"; // emojis work
        $comment->user_id = 2;
        $comment->post_id = 2;
        $comment->save();


        Comment::factory()->count(170)->create();
    }
}
