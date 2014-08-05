<?php

class OpenSnippetController extends BaseController {

	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();		
	}

	public function postQuery() {	

	$query = Input::get('query');
	
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
	else {
		return Redirect::to('/')->with('flash_message', 'Please type a valid query!');
		}
	}

	public function getSnippets($id = null) {
		if ($id == null) {
			$snippets = Snippet::all();
		}
		else {
			$snippets = Snippet::where('id', '=', $id)->first();
		}
		return View::make('snippet_view')->with('snippets', $snippets);
	}


	public function getTagSnippets($id) {
		$tag = Tag::where('id', '=', $id)->first();
		$snippets = $tag->snippets->toArray();
		return View::make('tag_snippet')->with('snippets',$snippets)->with('tag', $tag);
	}
}