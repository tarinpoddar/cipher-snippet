@extends('_master')


@section('content')

<h1 id = "mainheading"> View and Share tons of Code Snippets </h1>

	@foreach ($tags as $tag)


	<?php   
		$url = '/tag-snippet/'.$tag->id;
		//echo $url; 
		$types = ["btn btn-default", "btn btn-primary", "btn btn-success", "btn btn-info",
					 "btn btn-warning", "btn btn-danger"];

		$random = rand(0, 5);			 
	 
	echo Form::open(array('url' => $url, 'method' => 'get', 'class' => 'button_form'));  ?>
	
    		

    		{{ Form::button($tag->name, array('class' => $types[$random], 'type' => 'submit')); }}

		{{ Form::close() }}
	
	@endforeach
    	
	



@stop