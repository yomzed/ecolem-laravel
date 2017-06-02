<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Robot::class, function (Faker\Generator $faker) {

    $names = [
            'Alan',
            'Albert',
            'RDX',
            'Anthony-R',
            'Ben-RD',
            'RD2',
            'J-RD',
            'Bender',
            'R2D2',
            'C3PO',
            'Nono',
            'Carl',
            'Wall-E',
            'EvE'
    ];

    $types = [
            'DDR1',
            'DDR2',
            'DDR3',
            'DDR4',
    ];

    $name = $names[array_rand($names)];
    $type = $types[array_rand($types)];
  
  	return [
      	    'name'         => $name,
            'category_id'  => rand(1, 7),
            'user_id'      => rand(1, 3),
            'slug' 		   => str_slug($name),
            'description'  => $faker->paragraph(rand(2, 4)),
            'published_at' => $faker->dateTime(),
            'status'       => 'published',
            'power'        => rand(0, 100),
            'type'         => $type,
      ];
  
});
