<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	
	public function login(Request $request)
	{

		if($request->isMethod('post'))
		{	
			# Validation de formulaire
			$this->validate($request, [
				'email' => 'required|email',
				'password' => 'required|string|min:8|max:10',
				'rememberMe' => 'in:rememberMe'
			], [
				'email.required' => 'We need to know your email address!',
				'email.email' => 'Invalid email!'
			]);

			# Traitement des données
			if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
			{
				# Enregistrement d'un flash message dans la session
				session()->flash('message', 'Welcome to dashboard');

				return redirect()->intended('dashboard');
			}

			session()->flash('message', 'Failed to login');

			return back()->withInput(['email' => $request->email]);
		}

		return view('front.auth.login');
	}

	public function logout()
	{
		if(Auth::check())
		{
			Auth::logout();
			session()->flash('message', 'You have been disconnected');

			return redirect()->intended('/');
		}
		else
		{
			return redirect()->intended('/');
		}
	}
}
