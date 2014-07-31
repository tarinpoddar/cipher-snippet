<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Homepage
Route::get('/', function()
{
	return View::make('index');
});


Route::get('/signup',
	array(
		'before' => 'guest',
		function() {
	    	return View::make('signup');
		}
	)
);


Route::post('/signup', array('before' => 'csrf', function()
{

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

}));

Route::get('/login',
	array(
		'before' => 'guest',
		function() {
	    	return View::make('login');
		}
	)
);

Route::post('/login', array('before' => 'csrf', function()
{

	$credentials = Input::only('email', 'password');
	
		if (Auth::attempt($credentials, $remember = true)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::to('/login')
				->with('flash_message', 'Log in failed! please try again.')
				->withInput();
		}
		
		return Redirect::to('login');

}));

Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/')
    		->with('flash_message', 'Thank you for using Cipher Snippets! See you again soon');

});


Route::get('/profile', function()
{
	$collection = Snippet::all();
/*
	foreach($collection as $book) {
    	echo $book."<br>";
	} 
*/

	return View::make('profile')->with('collection', $collection);
});


# Display add form
Route::get('/add/', function() {

	return View::make('add');
	
});


Route::post('/add/', function() {


	$snippet = new Snippet();

	// $snippet->fill(Input::all());

	$snippet->title = Input::get('title');
	$snippet->language = Input::get('language');
	$snippet->code = Input::get('code');
	// connecting it to the user
	$snippet->user_id = Auth::id();
	$snippet->save();
	echo "snippet saved "."<br>";

	//$debug_new_count = 0;
	//$debug_old_count = 0;

	// loop 6 times for 6 tags
	for ($i=1; $i <= 6; $i++) { 
		
		// get the user input
		$tag = Input::get('tag'.$i);
		echo $tag;

		// if user has given some input
		if ($tag) {

			// Query the database to find if the tag exists
			// $tags = DB::select(DB::raw('select * from tags where name = recursion'));
			$tag_object = Tag::where('name', '=', $tag)->get();
			
			// if it exists - attach it to the snippet
			if (!$tag_object->isEmpty()) {
  					$snippet->tags()->attach($tag_object[0]);
			}
			

			// if it doesn't exist, create a new tag and attach it to the snippet
			else {
				$new_tag = Tag::create(array('name' => $tag));

				$snippet->tags()->attach($new_tag);
				//echo "created and attached new tag";
				//$debug_new_count++;
			}
		}	
	}

	echo "done";	
	/*
	echo "attached ".($debug_new_count+$debug_old_count)." new tags"."<br>";
	echo "created ".$debug_new_count." new tags"."<br>";
	echo "old ".$debug_old_count;
	*/
});










Route::get('/add-data', function() {

	// Generating some users	
	$user1 = new User;
	$user1->email = "mark@fb.com";
	$user1->name = "Mark Zuckerberg";
	$user1->password = Hash::make("Pricsilla");
	
	try {
		$user1->save();
	}
	catch (Exception $e) {
		return "Unsuccessful - couldn't generate new user1";
	}

	$user2 = new User;
	$user2->email = "steve@apple.com";
	$user2->name = "Steve Jobs";
	$user2->password = Hash::make("next");
	
	try {
		$user2->save();
	}
	catch (Exception $e) {
		return "Unsuccessful - couldn't generate new user2";
	}

	$user3 = new User;
	$user3->email = "larry@google.com";
	$user3->name = "Larry Page";
	$user3->password = Hash::make("google");
	
	try {
		$user3->save();
	}
	catch (Exception $e) {
		return "Unsuccessful - couldn't generate new user3";
	}


	# Tags (Created using the Model Create shortcut method)
	# Note: Tags model must have `protected $fillable = array('name');` in order for this to work
	$recursion     = Tag::create(array('name' => 'recursion'));
	$webdev        = Tag::create(array('name' => 'webdev'));
	$oop    	= Tag::create(array('name' => 'oop'));
	$rails       = Tag::create(array('name' => 'rails'));
	$mobile        = Tag::create(array('name' => 'mobile'));
	$functional         = Tag::create(array('name' => 'functional'));
	$loops = Tag::create(array('name' => 'loops'));


	// Generating some Snippets
	$snippet1 = new Snippet;
	$snippet1->title = "Recursive Backtracking";
	$snippet1->language = "Java";
	$snippet1->code = "for (int val = 1; val < (DIM + 1); val++)";

	// connecting it to the user
	$snippet1->user()->associate($user1);
	$snippet1->save();

	// attaching it to the tags
	$snippet1->tags()->attach($recursion);
	$snippet1->tags()->attach($loops);
	$snippet1->tags()->attach($mobile);



	// Generating some Snippets
	$snippet2 = new Snippet;
	$snippet2->title = "loops to build drawing";
	$snippet2->language = "Python";
	$snippet2->code = "public static final int SCALE_FACTOR = 3;";

	// connecting it to the user
	$snippet2->user()->associate($user2);
	$snippet2->save();

	// attaching it to the tags
	$snippet2->tags()->attach($oop);
	$snippet2->tags()->attach($mobile);
	$snippet2->tags()->attach($rails);

	return "All done - Hurray!!";

});

// Just to test my database connection
Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);

});

