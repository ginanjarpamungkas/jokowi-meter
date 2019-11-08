<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Administrator',
            'divisi' => 'Media Lab',
            'role' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'created_at' => '1996-09-28 21:17:50'
        ]);
    }
}
