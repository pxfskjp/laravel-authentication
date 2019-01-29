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
            'login' => 'laravel',
            'email' => 'laravel@gmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'login' => 'laravelos',
            'email' => 'laravelos@gmail.com',
            'password' => Hash::make('laravelos'),
        ]);
    }
}
