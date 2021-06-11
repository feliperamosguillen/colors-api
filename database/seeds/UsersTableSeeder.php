<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@colors.com',
            'password' => bcrypt('adminadmin'),
            'admin' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@colors.com',
            'password' => bcrypt('useruser'),
            'admin' => 0
        ]);
    }
}
