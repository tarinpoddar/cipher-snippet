<?php

class Tag extends Eloquent {
	
	# Relationship method
	public function books() {
		
        # Tags belong to many Books
        return $this->belongsToMany('Book');
    }
}