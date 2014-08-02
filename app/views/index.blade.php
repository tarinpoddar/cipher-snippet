@extends('_master')


@section('content')

<h1 id = "mainheading"> View and Share tons of Code Snippets </h1>

	@foreach ($tags as $tag)


	<?php   
		$url = '/tag-snippet/'.$tag->id;
		//echo $url; 
	 
	echo Form::open(array('url' => $url, 'method' => 'get'));  ?>
	
    		<button type="submit" class="btn btn-success"> {{ $tag->name }} </button>
		{{ Form::close() }}
	
	@endforeach
    	
	



@stop