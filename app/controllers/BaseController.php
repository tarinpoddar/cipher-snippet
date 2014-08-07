<?php

class BaseController extends Controller {


	// all post will only be submitted after csrf - for security reasons
	public function __construct() {
			
		 $this->beforeFilter('csrf', array('on' => 'post'));
		 
	}

}
