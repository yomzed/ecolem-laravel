<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Robot;
use App\Category;
use App\CacheInterface;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(CacheInterface $cache) 
    {
        $key = (request()->page == 1) ? 'robots' : 'robots' . request()->page;

        if($cache->has($key))
        {
            $robots = $cache->get($key);
        }
        else
        {
            $robots = Robot::published()->paginate(5);
            $cache->set($key, $robots);
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
