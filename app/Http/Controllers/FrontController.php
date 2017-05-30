<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Robot;
use App\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() 
    {   
    	$robots = Robot::paginate(5); # SELECT * FROM robots
    	$cat = Category::all();

    	return view('front.home', ['robots' => $robots, 'cat' => $cat]);
    }

    public function showRobot($id)
    {
    	$robot = Robot::find($id);
    	$tags  = $robot->tags;

    	return view('front.single', ['robot' => $robot, 'tags' => $tags]);
    }

    public function showRobotByCat($id)
    {	
    	$cats = Category::all();
    	$cat = Category::find($id);
    	$robots = $cat->robots;

    	return view('front.category', ['cat' => $cat, 'robots' => $robots, 'cats' => $cats]);
    }

    public function showRobotByTag(int $id)
    {
        $robots = Tag::findOrFail($id)->robots;
        $cats = Category::all();
        $tag = Tag::find($id);
        $tags = Tag::all();
    
        return view('front.tag', compact('robots', 'tag', 'cats', 'tags'));
    }
}
