<?php

// ALL USERS HAVE ACCESS TO THESE - EVEN THE NON LOGGED IN USERS
class OpenSnippetController extends BaseController {

	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();		
	}

	// Processing the search query on the website
	public function postQuery() {	

		// get the input
		$query = Input::get('query');
		
		// if there was an actual query
		if($query) {
			
				# Eager load tags and author
		 		$snippets = Snippet::with('tags')
		 		->whereHas('tags', function($q) use($query) {
				    $q->where('name', 'LIKE', "%$query%");
				})
				->orWhere('title', 'LIKE', "%$query%")
				->orWhere('language', 'LIKE', "%$query%")
				->get();	
				$snippets = $snippets->toArray();
				return View::make('query')->with('snippets', $snippets)
										  ->with('query', $query);	
		}
		// if there was no real data - blank query
		else {
			return Redirect::to('/')->with('flash_message', 'Please type a valid query!');
			}
	}

	// show the snippets to the users
	public function getSnippets($id = null) {
		
		// default - will show all snippets
		if ($id == null) {
			$snippets = Snippet::all();
		}

		// will show a particular snippet
		else {
			$snippets = Snippet::where('id', '=', $id)->first();
		}
		return View::make('snippet_view')->with('snippets', $snippets);
	}

	// clicking on a tag (category) - process and show the snippets associated to this tag
	public function getTagSnippets($id) {
		$tag = Tag::where('id', '=', $id)->first();
		$snippets = $tag->snippets->toArray();
		return View::make('tag_snippet')->with('snippets',$snippets)->with('tag', $tag);
	}
}