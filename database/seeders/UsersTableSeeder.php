<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test1 = new User();
        $test1->name = "Test User 1";
        $test1->email = "2130499@swansea.ac.uk";
        $test1->email_verified_at = now();
        $test1->password = "test1";
        $test1->display_name = "funny name";
        $test1->save();
        $test2 = new User();
        $test2->name = "Test User 2";
        $test2->email = "tschirpf@hu-berlin.de";
        $test2->email_verified_at = now();
        $test2->password = "test2";
        $test2->display_name = "hilarious name";
        $test2->save();

        User::factory()->count(30)->create();
    }
}
