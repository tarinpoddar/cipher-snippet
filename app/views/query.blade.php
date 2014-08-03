@extends('_master')


@section('content')

	
<!-- Many Snippets: use for each to trace through the array -->
@if (count($snippets) > 0)
	
	@foreach ($snippets as $snippet)

		<h4> <strong> {{ $snippet['title'] }} </strong> - {{ $snippet['language'] }}  </h4>
		<div class="jumbotron">
  			<p> {{ $snippet['code'] }} </p>
		</div>

	@endforeach

<!-- 1 single snippet -->
@else
	
	<h2> <strong> {{ $query }} </strong> could not be found! </h2>


@endif
@stop