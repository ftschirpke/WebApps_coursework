<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Account;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test1 = new Account();
        $test1->user_id = 1;
        $test1->display_name = "funny_name";
        $test1->save();
        $test2 = new Account();
        $test2->user_id = 2;
        $test2->display_name = "hilarious_name";
        $test2->save();
    }
}
