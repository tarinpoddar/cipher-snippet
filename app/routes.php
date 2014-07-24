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
	
	
		
});


// Just to test my database connection
Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);

});

