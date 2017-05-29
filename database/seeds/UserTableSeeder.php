<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                [
                        'name' => 'admin',
                        'email' => 'admin@admin.fr',
                        'password' => bcrypt('secret'),
                        'role' => 'administrator',
                ],
                [
                		'name' => 'Yoan',
                		'email' => 'martinezyoan@gmail.com',
                		'password' => bcrypt('raclette'),
                        'role' => 'administrator',
                ],
                [
                        'name' => 'Monique',
                        'email' => 'monique@monique.com',
                        'password' => bcrypt('raclette'),
                        'role' => 'editor',
                ],
        ]);
    }
}
