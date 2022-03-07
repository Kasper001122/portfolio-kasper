<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert([
            'Title'=>'This is a post ',
            'content'=>"Jane made this",
            'created_by'=>1,
            'deleted_by'=>null,
            'deleted_at'=>null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('posts')->insert([
            'Title'=>'There are too many posts ',
            'content'=>"Bobby made this",
            'created_by'=>2,
            'deleted_by'=>null,
            'deleted_at'=>null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('posts')->insert([
            'Title'=>'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA',
            'content'=>"Susan made this",
            'created_by'=>3,
            'deleted_by'=>null,
            'deleted_at'=>null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
