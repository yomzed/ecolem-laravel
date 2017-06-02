<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Tag;
use App\Robot;
use App\Category;
use App\CacheInterface;
use Illuminate\Http\Request;
use App\Http\Requests\RobotRequest;
use App\Http\Controllers\Controller;

class RobotController extends Controller
{
	use UserAdmin;

	public function __construct()
	{
		$this->setUser();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(CacheInterface $cache)
	{   
		$key = (request()->page == 1) ? 'bo-robots' : 'bo-robots' . request()->page;

		if($cache->has($key))
        {
            $robots = $cache->get($key);
        }
        else
        {
            $robots = Robot::with('tags', 'category', 'user')->orderBy('created_at', 'desc')->paginate(6);
            $cache->set($key, $robots);
        }

		return view('back.robot.index', compact('robots'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{   
		$this->authorize('create', Robot::class);

		$cats = Category::pluck('title', 'id');
		$tags = Tag::pluck('name', 'id');
		
		return view('back.robot.create', compact('cats', 'tags'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(RobotRequest $request, CacheInterface $cache)
	{  
		$robot = Robot::create($request->all());
		$robot->tags()->attach($request->tags);
		$robot->user_id = $request->user()->id;
		$robot->save();

		$cache->flush();

		# Traitement du fichier
		if($request->hasFile('picture'))
		{
			$file = $request->picture; 
			$ext  = $file->extension();

			# Génération du nom et sauvegarde dans la BDD
			$robot->link = str_random(12) . '.' . $ext;
			$robot->save();

			# Déplacement du fichier dans le dossier public
			$file->storeAs( 'img',  $robot->link );
		}


		return redirect()->route('robot.index')->with('message', sprintf('%s has been created', $robot->name));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Robot $robot)
	{
		$this->authorize('update', $robot);

		$cats  = Category::pluck('title', 'id');
		$tags  = Tag::pluck('name', 'id');

		return view('back.robot.edit', compact('robot', 'cats', 'tags'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(RobotRequest $request, Robot $robot, CacheInterface $cache)
	{	
		# Update de l'image
		if($request->hasFile('picture'))
		{	
			# Suppression de l'ancienne image si existante
			if( !empty($robot->link) && File::exists( public_path('img') . '/' . $robot->link ) )
				File::delete( public_path('img') . '/' . $robot->link );

			$file = $request->picture; 
			$ext  = $file->extension();

			# Génération du nom et sauvegarde dans la BDD
			$robot->link = str_random(12) . '.' . $ext;
			$robot->save();



			# Déplacement du fichier dans le dossier public
			$file->storeAs( 'img',  $robot->link );

		}

		# Suppression de l'image
		if( empty($request->file_name) && !empty($robot->link) && File::exists( public_path('img') . '/' . $robot->link ) ) 
		{
			File::delete( public_path('img') . '/' . $robot->link );
			$robot->link = '';
			$robot->save();
		}

		$robot->update($request->all());
		$robot->tags()
			  ->sync($request->tags); # ->sync() : fonction magique qui supprime/insère

		$cache->flush();

		return redirect()->route('robot.index')->with('message', sprintf('%s has been updated', $robot->name));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Robot $robot, CacheInterface $cache)
	{	

		$this->authorize('delete', $robot);

		if( !empty($robot->link) && File::exists( public_path('img') . '/' . $robot->link ) )
		{	
			File::delete( public_path('img') . '/' . $robot->link );
		}

		$name = $robot->name;
		$robot->delete();

		$cache->flush();

		return redirect()->route('robot.index')->with('message', sprintf('Bot %s successfully destroyed', $name));
	}
}