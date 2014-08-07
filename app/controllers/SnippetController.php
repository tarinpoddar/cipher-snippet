<?php

class SnippetController extends BaseController {


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		
		# Make sure BaseController construct gets called
		parent::__construct();		
		
		# Only logged in users should have access to this controller
		$this->beforeFilter('auth');
	}

	
	# Display add a snippet form
	public function getAdd() {		
		return View::make('add');
	}

	// processes the add a snippet form filled in by the user
	public function postAdd() {

		# Step 1) Define the rules			
		$rules = array(
			'title' => 'required',
			'language' => 'required',
			'code' => 'required'	
		);

		# Step 2) 		
		$validator = Validator::make(Input::all(), $rules);

		# Step 3)
		if($validator->fails()) {
			
			return Redirect::to('/add')
				->with('flash_message', "Oh Snap! Couldn't add the snippet. please fix the errors listed below.")
				->withInput()
				->withErrors($validator);
		}		

	// processes the filled in by the user
	$snippet = new Snippet();
	$snippet->title = Input::get('title');
	$snippet->language = Input::get('language');
	$snippet->code = Input::get('code');
	// connecting it to the user
	$snippet->user_id = Auth::id();
	$snippet->save();
	
	// processing the tags input of the user
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
	}

	// gets the edit form to the user - with prefilled details of the snippet
	public function getEdit($id) {

		$snippet = Snippet::find($id);
		$tags = $snippet->tags;
		return View::make('edit')->with('snippet', $snippet)
							 	 ->with('tags', $tags);
		
	}
	
	// processes the edit form - snippet details which are changed by the user 
	public function postEdit($id) {

		// VALIDATION
		# Step 1) Define the rules			
		$rules = array(
			'title' => 'required',
			'language' => 'required',
			'code' => 'required'	
		);

		# Step 2) 		
		$validator = Validator::make(Input::all(), $rules);

		# Step 3)
		if($validator->fails()) {
			
			return Redirect::to('/edit/'.$id)
				->with('flash_message', "Oh Snap! Couldn't add the snippet. please fix the errors listed below.")
				->withInput()
				->withErrors($validator);
		}		
		
		// Find the snippet user has editted
		$snippet = Snippet::find($id);

		// process the snippet with the new details - save the details
		$snippet->title = Input::get('title');
		$snippet->language = Input::get('language');
		$snippet->code = Input::get('code');
		$snippet->save();
		
		// processing the tags
		// gets the old tags
		$oldTags = $snippet->tags;

		// saves them in an array
		$oldTagsArr = [];
			foreach ($oldTags as $eachTag) {
				array_push($oldTagsArr, $eachTag->name);
			}

			// loops 6 times to process the 6 tags
			for ($i=1; $i <= 6; $i++) {

					// get the user input
					$tag = Input::get('tag'.$i);
			
					// if there is some input
					if ($tag) {

						// this tag is already connected to the snippet
						if (in_array($tag, $oldTagsArr)) {

							// delete this tag from the array oldTagsArr
							if(($key = array_search($tag, $oldTagsArr)) !== false) {
	   							unset($oldTagsArr[$key]);
							}
						}

						// when the tag is not connected to the snippet
						else {

							// Query the database to find if the tag exists
							$tag_object = Tag::where('name', '=', $tag)->get();
							
							// if there is no such tag, create one and attach it to the snippet
							if ($tag_object->isEmpty()) {
								$new_tag = Tag::create(array('name' => $tag));
								$snippet->tags()->attach($new_tag);
							}

							// there is a tag but aint' attached to the snippet 
							else {
								$snippet->tags()->attach($tag_object->first());
							}

						}
					}
			}

			//DELETE OLD RELATIONS
			foreach ($oldTagsArr as $eachTag) {
				if ($eachTag) {
					$tag_object = Tag::where('name', '=', $eachTag)->get()->first();

					DB::table('snippet_tag')->where('tag_id', '=', $tag_object['id'])
											->where('snippet_id', '=', $id)
											->delete();
				}
			}
			
		return Redirect::to('/profile')->with('flash_message', "Your changes have been saved!");
	}
	
	// DELETING THE SNIPPET
	public function getDelete($id) {

		DB::table('snippet_tag')->where('snippet_id', '=', $id)->delete();
		Snippet::where('id', '=', $id)->delete();
		return Redirect::to('/profile')->with('flash_message', "Snippet Deleted!");

	}

}
