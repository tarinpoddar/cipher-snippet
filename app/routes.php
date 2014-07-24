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

