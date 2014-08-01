@extends('_master')


@section('content')

<h1 id = "mainheading"> View and Share tons of Code Snippets </h1>

	

	<?php   
		$url = '/tag-snippet/'.$tags[2]->id;
		//echo $url; 
	 
	echo Form::open(array('url' => $url, 'method' => 'get'));  ?>
	
    		<button type="submit" class="btn btn-success"> {{ $tags[2]->name }}</button>
		{{ Form::close() }}
	
    	
	



@stop