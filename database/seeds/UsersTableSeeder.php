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
            'name' => 'Admin User',
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'approved' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Approved User',
            'email' => env('APPROVED_EMAIL'),   
            'password' => bcrypt(env('APPROVED_PASSWORD')),
            'approved' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Unapproved User',
            'email' => env('UNAPPROVED_EMAIL'),
            'password' => bcrypt(env('UNAPPROVED_PASSWORD')),
            'approved' => 0
        ]);
    }
}
