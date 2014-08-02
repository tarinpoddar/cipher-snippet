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
	$tags = Tag::all();
	// echo Pre::render($tags);
	return View::make('index')->with('tags', $tags);
});


/*-------------------------------------------------------------------------------------------------
// ! User
Explicit Routing
-------------------------------------------------------------------------------------------------*/
# Note: the beforeFilter for 'guest' on getSignup and getLogin is handled in the Controller
Route::get('/signup', 'UserController@getSignup'); 
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', ['before' => 'csrf', 'uses' => 'UserController@postSignup'] );
Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@postLogin'] );
Route::get('/logout', ['before' => 'auth', 'uses' => 'UserController@getLogout'] );



Route::get('/profile', function()
{
	$live_user = Auth::user();
	$snippets = Snippet::where('user_id', '=', $live_user->id)->get()->reverse()->toArray();

	// echo Pre::render($snippets);

	return View::make('profile')->with('snippets', $snippets)
								->with('live_user', $live_user);

});


# Display Snippets
Route::get('/snippets/{id?}', function($id = null) {

	if ($id == null) {
		$snippets = Snippet::all();
		return View::make('snippet_view')->with('snippets', $snippets);
	}
	
	else {
		$snippets = Snippet::where('id', '=', $id)->first();
		return View::make('snippet_view')->with('snippets', $snippets);
	}	
});


# Display Snippets based on tags
Route::get('/tag-snippet/{id}', function($id) {

	$tag = Tag::where('id', '=', $id)->first();
	$snippets = $tag->snippets->toArray();
	$tag = $tag->toArray();

	return View::make('tag_snippet')->with('snippets',$snippets)->with('tag', $tag);
});






# Display add form
Route::get('/add/', function() {

	return View::make('add');
	
});


Route::post('/add/', function() {


	$snippet = new Snippet();

	$snippet->title = Input::get('title');
	$snippet->language = Input::get('language');
	$snippet->code = Input::get('code');
	// connecting it to the user
	$snippet->user_id = Auth::id();
	$snippet->save();
	

	// loop 6 times for 6 tags
	for ($i=1; $i <= 6; $i++) { 
		
		// get the user input
		$tag = Input::get('tag'.$i);
		

		// if user has given some input
		if ($tag) {

			// Query the database to find if the tag exists
			// $tags = DB::select(DB::raw('select * from tags where name = recursion'));
			$tag_object = Tag::where('name', '=', $tag)->get();
			
			// if it exists - attach it to the snippet
			if (!$tag_object->isEmpty()) {
  					$snippet->tags()->attach($tag_object->first());
			}
			

			// if it doesn't exist, create a new tag and attach it to the snippet
			else {
				$new_tag = Tag::create(array('name' => $tag));

				$snippet->tags()->attach($new_tag);
			}
		}	
	}

	return Redirect::to('/profile')->with('flash_message', 'Your Snippet has been added');	
});

















/* ###### Helper Function ###### */

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


/*
Route::get('/delete-data', function() {
	
	# Clear the tables to a blank slate
	DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
	DB::statement('TRUNCATE snippets');
	DB::statement('TRUNCATE users');
	DB::statement('TRUNCATE tags');
	DB::statement('TRUNCATE snippet_tag');

	return "data deleted =(  CHECK DATABASE";
});
*/

