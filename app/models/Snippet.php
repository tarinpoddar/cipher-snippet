<?php

class Snippet extends Eloquent {

	# Relationship method...
    public function tags() {
    
    	# Books belong to many Tags
        return $this->belongsToMany('Tag');
    }


	
}