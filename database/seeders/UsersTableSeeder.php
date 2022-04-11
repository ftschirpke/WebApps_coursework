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
        $admin = new User();
        $admin->name = "Main Admin";
        $admin->email = "admin@email.com";
        $admin->email_verified_at = now();
        $admin->password = Hash::make("admin");
        // hash of the password
        // -> you can sign in by typing "admin"
        $admin->is_admin = true;
        $admin->setRememberToken("adminadmin"); // up to 100 characters, so 10 is fine
        // setting the remember although it's nullable
        // because the framework doesn't use it, when it's null
        // if it's set, the value is updated upon logout
        // therefore, the initial value doesn't really matter 
        $admin->save();

        $test1 = new User();
        $test1->name = "Test User 1";
        $test1->email = "funny@email.com";
        $test1->email_verified_at = now();
        $test1->password = Hash::make("test1");
        $test1->is_admin = false;
        $test1->setRememberToken("aaaabcaaaa");
        $test1->save();

        $test2 = new User();
        $test2->name = "Test User 2";
        $test2->email = "hilarious@email.com";
        $test2->email_verified_at = now();
        $test2->password = Hash::make("test2");
        $test2->is_admin = false;
        $test2->setRememberToken("bbbbcdbbbb");
        $test2->save();

        $test1->users_friendship_requests_sent_to()->attach([1, 3]);
        $test2->users_friendship_requests_sent_to()->attach([1, 2]);
        
        User::factory()->count(20)->hasAccount()->create();
        // calling hasAccount() on all the created users
        // automatically calls the AccountFactory
        // and links the created accounts accordingly
    }
}
