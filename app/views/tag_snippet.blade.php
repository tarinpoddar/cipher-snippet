@extends('_master')

@section('title')
	Snippets
@stop

@section('content')



	<h3> <strong> Tag: </strong> {{ $tag['name'] }}  </h3>

	@if (count($snippets) == 0)

		<h4> Sorry there are no snippets associated with this tag </h4>

	@elseif (count($snippets) > 0)

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

	@endif


@stop