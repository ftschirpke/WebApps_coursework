<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post_report = new Report();
        $post_report->user_id = 2;
        $post_report->category = 'other';
        $post_report->message = 'Sorry, just wanted to report something.';
        $post_report->reportable_id = 1;
        $post_report->reportable_type = "Post";
        $post_report->save();

        $comment_report = new Report();
        $comment_report->user_id = 3;
        $comment_report->category = 'other';
        $comment_report->message = 'I reported the first ever comment. YEY';
        $comment_report->reportable_id = 1;
        $comment_report->reportable_type = "Comment";
        $comment_report->save();
    }
}
