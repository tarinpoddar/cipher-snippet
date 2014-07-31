<?php

class UserController extends BaseController {


	public function __construct() {
        $this->beforeFilter('guest', array('only' => array('getLogin','getSignup')));	
    }


    public function getSignup() {
		
		return View::make('signup');
		
	}

	public function postSignup() {

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
	
}