<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // Insert a default user
        DB::table('users')->insert([
            'name' => 'haseeb',
            'email' => 'haseeb@gmail.com',
            'password' => Hash::make('89cc9aca'), // Manually hashed password
        ]);
    }
}
