<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use UserAdmin;

    public function __construct()
    {
    	$this->setUser();
    }

    public function index()
    {	
    	return view('back.dashboard');
    }
}
