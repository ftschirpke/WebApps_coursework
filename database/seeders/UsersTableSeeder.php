<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $test1->email = "funny@email.com";
        $test1->email_verified_at = now();
        $test1->password = Hash::make("test1");
        // hash of the password
        // -> you can sign in by typing "test1"
        $test1->setRememberToken("aaaabcaaaa"); // up to 100 characters, so 10 is fine
        // setting the remember although it's nullable
        // because the framework doesn't use it, when it's null
        // if it's set, the value is updated upon logout
        // therefore, the initial value doesn't really matter 
        $test1->save();

        $test2 = new User();
        $test2->name = "Test User 2";
        $test2->email = "hilarious@email.com";
        $test2->email_verified_at = now();
        $test2->password = Hash::make("test2");
        $test2->setRememberToken("bbbbcdbbbb");
        $test2->save();

        User::factory()->count(20)->hasAccount()->create();
        // calling hasAccount() on all the created users
        // automatically calls the AccountFactory
        // and links the created accounts accordingly
    }
}
