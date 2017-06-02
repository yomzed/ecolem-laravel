<?php 

namespace App\Http\Controllers\Admin;

use Auth;

trait UserAdmin {

	public function setUser() 
	{
		view()->composer('layouts.admin', function($view) {
			$user = Auth::user();
			$view->with('user', $user);
		});
	}
}