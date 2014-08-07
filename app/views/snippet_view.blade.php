@extends('_master')

@section('title')
	Snippets
@stop


@section('content')

<!-- Many Snippets: use for each to trace through the array -->
@if (count($snippets) > 1)
	
	@foreach ($snippets as $snippet)

		<h4> <strong> {{ $snippet['title'] }} </strong> - {{ $snippet['language'] }}  </h4>
		<div class="jumbotron">
			<!-- Quick fix dirty solution to printing blank lines inbetween which weren't printed by default --> 
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
	
	<h4> <strong> {{ $snippets['title'] }} </strong> - {{ $snippets['language'] }}  </h4>
	<div class="jumbotron">	
		<!-- Quick fix dirty solution to printing blank lines inbetween which weren't printed by default --> 
			<?php 
				$code = str_replace("\n", "<br>", $snippets['code']);
				$code = str_replace(" ", "&nbsp", $code);
				echo "<p>";
				echo $code;
				echo "</p>";
	  		?>
  	</div>
@endif

@stop