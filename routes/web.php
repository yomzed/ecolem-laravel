<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontController@index')->name('home');
Route::get('/robot/{id}', 'FrontController@showRobot');
Route::get('/category/{id}', 'FrontController@showRobotByCat');
Route::get('/tag/{id}', 'FrontController@showRobotByTag');


# Login
Route::any('login', 'Admin\LoginController@login')->name('login');
Route::get('logout', 'Admin\LoginController@logout')->name('logout');

# Dashboard (Groupe qui vérifie l'authentification)
Route::group(['middleware' => 'auth'], function() {

	Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

	# Ensemble de routes qui se connecte au Controller de la ressource Robot (CRUD) 
	# `route:list` pour afficher les routes
	# en console
	Route::resource('admin/robot', 'Admin\RobotController');
});

