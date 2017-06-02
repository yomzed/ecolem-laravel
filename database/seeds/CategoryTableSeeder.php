<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	['title' => 'Time Machine'],
        	['title' => 'Engineering'],
        	['title' => 'Military'],
        	['title' => 'Space Explorer'],
        	['title' => 'Personal Assistant'],
        	['title' => 'Medical'],
        	['title' => 'Energy']
        ]);
    }
}
