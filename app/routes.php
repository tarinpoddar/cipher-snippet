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

Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/')
    		->with('flash_message', 'Thank you for using Cipher Snippets! See you again soon');

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

















# Display add form
Route::get('/add/', function() {

	return View::make('add');
	
});


# Process add form
Route::post('/add/', function() {
	
	$current_tag = Input::get('tag1');
	$tag_in_table = DB::table('tags')->where('name', $current_tag)->pluck('name');

	if ($tag_in_table) {
		echo $current_tag."<br>";
		echo $tag_in_table."<br>";
		echo "found";
	}
	else {

		echo $tag_in_table."<br>";
		echo "not found";
	}

	$particular_row = DB::table('tags')->where('name', $current_tag)->get();
	
	// echo $particular_row->['name'];
	// dd($particular_row);
	return Pre::render($particular_row);



	
	// echo Pre::render(Input::all());
	
	$new_snippet = new Snippet();

	$new_snippet->title = Input::get('title');
	$new_snippet->language = Input::get('language');
	$new_snippet->code = Input::get('code');

	// made entry in the table (added to database)
	$new_snippet->save();


	// Working on the tags below:

	$i = 1; // tag counter
	$current_tag_num = "tag".$i;
	$current_tag = Input::get($current_tag_num);

	// if user has given a input for the particular tag
	while ($current_tag) {

		// finding that particular tag in the tags table
		$particular_row = DB::table('tags')->where('name', '=', $current_tag)->get();
		$tag_name = $particular_row->name;

		// if the current tag exists in the table
		if($tag_in_table) {
// check
			// link the snippet to this particular tag
			$new_snippet->tags()->attach($tag_in_table);

		}

		else {
			
			// create a new tag
			$new_tag = new Tag();
			$new_tag->name = $current_tag;
			$new_tag->save(); // add it to the database

			// connect it to the snippet
			$new_snippet->tags()->attach($new_tag);
		}

		$i++;
		$current_tag_num = "tag".$i;
		$current_tag = Input::get($current_tag_num);
	}

	return "Added a new row";
		
});


// Just to test my database connection
Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);

});

