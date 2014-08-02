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


	public function getEdit($id) {
		
		
		$snippet = Snippet::find($id);
		//echo Pre::render($snippet);
		$tags = $snippet->tags;
		//echo $tags[2]['name'];
		//echo count($tags);
		//echo $tags[2]['name'];
		//echo Pre::render($tags);

		//dd();
		//return "yes route".$id;
		//return View::make('edit');

		return View::make('edit')->with('snippet', $snippet)
							 	 ->with('tags', $tags);
		
	}
	
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function postEdit($id) {
		
		$snippet = Snippet::find($id);
 
		$snippet->title = Input::get('title');
		$snippet->language = Input::get('language');
		$snippet->code = Input::get('code');
		$snippet->save();
		
		$oldTags = $snippet->tags;

		$oldTagsArr = [];

			foreach ($oldTags as $eachTag) {
				array_push($oldTagsArr, $eachTag->name);
			}

			for ($i=1; $i <= 6; $i++) {

					// get the user input
					$tag = Input::get('tag'.$i);
		
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

			/* DELETE OLD RELATIONS
			foreach ($oldTags as $eachTag) {
				if ($eachTag) {

				}
			}
			*/
		
		return Redirect::to('/profile')->with('flash_message', "Your changes have been saved!");

		//return View::make('profile')->with('flash_message', "Your changes have been saved!");
		//echo Pre::render($snippet);

		
	}
	
}
