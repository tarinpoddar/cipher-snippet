<?php

class UserController extends BaseController {


	public function __construct() {
        $this->beforeFilter('guest', array('only' => array('getLogin','getSignup')));	
    }


    public function getSignup() {
		
		return View::make('signup');
		
	}

	public function postSignup() {

		# Step 1) Define the rules			
		$rules = array(
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6'	
		);

		# Step 2) 		
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {
			
			return Redirect::to('/signup')
				->with('flash_message', 'Oh Snap! Sign up failed! please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}		

		$user = new User;
		$user->name = Input::get('name');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));

		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::to('/')
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput();
		}

		# Log in
		Auth::login($user);
		return Redirect::to('/')->with('flash_message', 'Welcome to Cipher Snippets!');
	}


	public function getLogin() {
		return View::make('login');
	}


	public function postLogin() {

		# Step 1) Define the rules			
		$rules = array(
			'email' => 'required|email',
			'password' => 'required'	
		);

		# Step 2) 		
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {
			
			return Redirect::to('/login')
				->with('flash_message', 'Oh Snap! Login failed! please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}		


		$credentials = Input::only('email', 'password');
	
		if (Auth::attempt($credentials, $remember = true)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');							  
		}
		else {
			return Redirect::to('/login')->with('flash_message', 'Log in failed! please try again.');
		}
		return Redirect::to('login');
	}

	public function getLogout() {

		# Log out
    	Auth::logout();

    	# Send them to the homepage
    	return Redirect::to('/')
    					->with('flash_message', 'Thank you for using Cipher Snippets! See you again soon');
	}

	public function getProfile() {
		$live_user = Auth::user();
		$snippets = Snippet::where('user_id', '=', $live_user->id)->get()->reverse()->toArray();

		return View::make('profile')->with('snippets', $snippets)
									->with('live_user', $live_user);

	}
	
}