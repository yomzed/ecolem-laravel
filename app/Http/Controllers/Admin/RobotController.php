<?php

namespace App\Http\Controllers\Admin;

use App\Robot;
use App\Category;
use App\Tag;
use File;
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
	public function index()
	{   
		$robots = Robot::orderBy('created_at', 'desc')->paginate(5);

		return view('back.robot.index', compact('robots'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{   
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
	public function store(RobotRequest $request)
	{  
		$robot = Robot::create($request->all());
		$robot->tags()->attach($request->tags);

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
	public function edit($id)
	{
		$robot = Robot::findOrFail($id);
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
	public function update(RobotRequest $request, $id)
	{	
		if($request->hasFile('picture'))
		{
			dd('FILE' . $request->link);
		}
		dd('NO FILE');
		$robot = Robot::find($id);
		$robot->update($request->all());
		$robot->tags()
			  ->sync($request->tags); # ->sync() : fonction magique qui supprime/insère 

		return redirect()->route('robot.index')->with('message', sprintf('%s has been updated', $robot->name));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$robot = Robot::find($id);

		if( !empty($robot->link) && File::exists( public_path('img') . '/' . $robot->link ) )
		{	
			File::delete( public_path('img') . '/' . $robot->link );
		}

		$name = $robot->name;
		$robot->delete();

		return redirect()->route('robot.index')->with('message', sprintf('Bot %s successfully destroyed', $name));
	}
}