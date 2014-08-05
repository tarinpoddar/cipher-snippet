@extends('_master')

@section('title')
	{{ $query }}
@stop

@section('content')

	
<!-- Many Snippets: use for each to trace through the array -->
@if (count($snippets) > 0)
	
	@foreach ($snippets as $snippet)

		<h4> <strong> {{ $snippet['title'] }} </strong> - {{ $snippet['language'] }}  </h4>
		<div class="jumbotron">
  			
  			<?php 
				$code = str_replace("\n", "<br>", $snippet['code']);
				$code = str_replace(" ", "&nbsp", $code);
				echo "<p>";
				echo $code;
				echo "</p>";
	  		?>

		</div>

	@endforeach

<!-- 1 single snippet -->
@else
	
	<h2> <strong> {{ $query }} </strong> could not be found! </h2>


@endif
@stop