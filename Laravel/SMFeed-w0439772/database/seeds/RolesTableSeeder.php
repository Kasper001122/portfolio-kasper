<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'name'=>'User Administrator',
            'description'=>'Administrator of admins',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'name'=>'Moderator',
            'description'=>'Moderator of the website',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('roles')->insert([
            'name'=>'Theme Manager',
            'description'=>'Manages the themes of the website',
            'created_at' => now(),
            'updated_at' => now()

        ]);
    }
}
