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
            'email' => 'ww_admin@gmail.com',
            'password' => bcrypt('werewolfadmin'),
            'approved' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Approved User',
            'email' => 'ww_approved@gmail.com',
            'password' => bcrypt('werewolfadmin'),
            'approved' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Unapproved User',
            'email' => 'ww_unapproved@gmail.com',
            'password' => bcrypt('werewolfadmin'),
            'approved' => 0
        ]);
    }
}
