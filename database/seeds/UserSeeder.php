<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'=>'1',
            'name'=>'MAdmin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('pass1234'),

        ]);
        DB::table('users')->insert([
            'role_id'=>'2',
            'name'=>'MAuthor',
            'username'=>'Author',
            'email'=>'author@gmail.com',
            'password'=>bcrypt('pass1234'),

        ]);
    }
}
