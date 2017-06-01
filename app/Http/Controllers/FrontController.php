<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Robot;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontController extends Controller
{
    public function index(Request $request) 
    {   
        if(Cache::has('robots' . $request->page)) {
            $robots = Cache::get('robots' . $request->page);
        }
        else {
            $robots = Robot::published()->paginate(5);
            Cache::put('robots' . $request->page, $robots, \Carbon\Carbon::now()->addMinutes(5));
        }
    	
    	$cat = Category::withCount('robots')->get();

    	return view('front.home', compact('robots', 'cat'));
    }

    public function showRobot(int $id)
    {
    	$robot = Robot::find($id);

    	return view('front.single', compact('robot'));
    }

    public function showRobotByCat(int $id)
    {	
    	$cats = Category::withCount('robots')->get();
    	$cat = Category::find($id);

    	return view('front.category', compact('cat', 'cats'));
    }

    public function showRobotByTag(int $id)
    {
        $tag = Tag::find($id);
        $tags = Tag::withCount('robots')->get();
    
        return view('front.tag', compact('robots', 'tag', 'tags'));
    }
}
