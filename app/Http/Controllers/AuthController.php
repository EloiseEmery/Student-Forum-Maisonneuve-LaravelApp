<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.registration');
    }

	/**
     * Authenticate the user
	 * @param Request $request
     */
    public function customLogin(Request $request)
    {
        $request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');
		if(!Auth::validate($credentials)):
			return redirect('login')->withErrors(trans('auth.failed'));	
		endif;

		$user = Auth::getProvider()->retrieveByCredentials($credentials);

		Auth::login($user, $request->get('remember'));

		return redirect()->intended('dashboard')->withSuccess('Connecté');
	}

	/**
     * Display the user Dashboard.
     */
	public function dashboard()
	{
		$name = 'Invité';
		if(Auth::check()):
			$name = Auth::user()->name;
		endif;
		return view('auth.dashboard', ['name' => $name, 'email' => Auth::user()->email]);
	}

	/**
     * Logout the user and redirect to the login page.
     */
	public function logout()
	{
		Session::flush();
		Auth::logout();

		return redirect('login');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
