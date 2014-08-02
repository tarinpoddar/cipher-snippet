@extends('_master')


@section('content')

	
<!-- Many Snippets: use for each to trace through the array -->
@if (count($snippets) > 1)
	
	@foreach ($snippets as $snippet)

		<h4> <strong> {{ $snippet['title'] }} </strong> - {{ $snippet['language'] }}  </h4>
		<div class="jumbotron">
  			<p> {{ $snippet['code'] }} </p>
		</div>

	@endforeach

<!-- 1 single snippet -->
@else
	
	<h4> <strong> {{ $snippets['title'] }} </strong> - {{ $snippets['language'] }}  </h4>
	<div class="jumbotron">	
  		<p> {{ $snippets['code'] }} </p>	
  	</div>


@endif
@stop