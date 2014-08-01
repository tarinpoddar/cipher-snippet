@extends('_master')


@section('content')



	<h3> <strong> Tag: </strong> {{ $tag['name'] }}  </h3>
	
<!-- Many Snippets: use for each to trace through the array -->
@if (count($snippets) > 1)
	
	@foreach ($snippets as $snippet)

		<h4> <strong> {{ $snippet['title'] }} </strong> - {{ $snippet['language'] }}  </h4>
		<div class="jumbotron">
  			<p> {{ $snippet['code'] }} </p>
		</div>

	@endforeach

<!-- 1 single snippet -->
@elseif (count($snippets) == 1) 
	
	<h4> <strong> {{ $snippets['title'] }} </strong> - {{ $snippets['language'] }}  </h4>
	<div class="jumbotron">	
  		<p> {{ $snippets['code'] }} </p>	
  	</div>

<!-- No snippets -->
@else 
	<h4> Sorry there are no snippets associated with this tag </h4>
@endif



@stop