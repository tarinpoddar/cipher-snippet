<?php

class Tag extends Eloquent {
	
	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');
	
	# Relationship method
	public function snippets() {
		
        # Tags belong to many Snippets
        return $this->belongsToMany('Snippet');
    }
}