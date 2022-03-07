<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'Jane UserAdmin',
            'email'=>'jane@example.com',
            'password'=>Hash::make('password'),
            'deleted_by'=>null,
            'deleted_at'=>null,
            'created_at' => now(),
            'updated_at' => now()

        ]);
        DB::table('users')->insert([
            'name'=>'Bob Moderator',
            'email'=>'bob@example.com',
            'password'=>Hash::make('password'),
            'deleted_by'=>null,
            'deleted_at'=>null,
            'created_at' => now(),
            'updated_at' => now()

        ]);
        DB::table('users')->insert([
            'name'=>'Susan ThemeAdmin',
            'email'=>'susan@example.com',
            'password'=>Hash::make('password'),
            'deleted_by'=>null,
            'deleted_at'=>null,
            'created_at' => now(),
            'updated_at' => now()

        ]);
        DB::table('users')->insert([
            'name'=>'Jon Nobody',
            'email'=>'jon@example.com',
            'password'=>Hash::make('password'),
            'deleted_by'=>null,
            'deleted_at'=>null,
            'created_at' => now(),
            'updated_at' => now()

        ]);
    }
}
