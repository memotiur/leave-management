<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \App\User::create([
                'name' => "Admin",
                'username' => "admin",
                'phone' => "01717849968",
                'email' => "admin@gmail.com",
                'designation' => "Commissioner",
                'usertype' => "1",
                'authority_id' => "0",
                'password' => Hash::make('123456'),
            ]
        );
    }
}
