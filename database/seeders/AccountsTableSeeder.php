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
        $admin = new Account();
        $admin->user_id = 1;
        $admin->display_name = "definitelyNotTheAdmin";
        $admin->save();

        // two example accounts with and without icon
        $test1 = new Account();
        $test1->user_id = 2;
        $test1->display_name = "funny_name";
        $test1->icon = "https://via.placeholder.com/100";
        $test1->save();
        $test2 = new Account();
        $test2->user_id = 3;
        $test2->display_name = "hilarious_name";
        // icon is optional, user 2 doesn't have one
        $test2->save();
        // the AccountFactory gets called in the UsersTableSeeder
    }
}
