<?php

class Snippet extends Eloquent {


    # The guarded properties specifies which attributes should *not* be mass-assignable
    //protected $guarded = array('id', 'user_id', 'created_at', 'updated_at');

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