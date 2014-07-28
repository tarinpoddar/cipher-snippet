<?php

class Snippet extends Eloquent {


	# Relationship method...
    public function user() {
    
    	# Snippet belongs to User
	    return $this->belongsTo('User');
    }



	# Relationship method...
    public function tags() {
    
    	# Snippets belong to many Tags
        return $this->belongsToMany('Tag');
    }


	
}