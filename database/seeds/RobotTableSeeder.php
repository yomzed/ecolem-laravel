<?php

use Illuminate\Database\Seeder;

class RobotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uploads = public_path('img');
        $files   = File::allFiles($uploads);
        foreach($files as $file) File::delete($file);

        factory(App\Robot::class, 30)->create()->each(function($robot) use($uploads) {

            $nbTags = App\Tag::all()->count();

        	$max   = rand(1, $nbTags);
            $tags = range(1, $nbTags);
        	shuffle($tags);
        	$index = array();

        	for( $i = 0; $i < $max; $i++ ) $index[] = $tags[$i];

        	$robot->tags()->attach($index);

            $uri   = str_random(12) . '.jpg';
            $image = file_get_contents('http://lorempicsum.com/futurama/350/200/' . rand(1,9));

            File::put($uploads . DIRECTORY_SEPARATOR . $uri, $image);

            $robot->link = $uri;

            $robot->save();

        });
    }
}
