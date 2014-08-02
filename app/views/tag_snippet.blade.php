@extends('_master')


@section('content')



	<h3> <strong> Tag: </strong> {{ $tag['name'] }}  </h3>

	@if (count($snippets) == 0)

		<h4> Sorry there are no snippets associated with this tag </h4>

	@elseif (count($snippets) > 0)

		@foreach ($snippets as $snippet)

			<h4> <strong> {{ $snippet['title'] }} </strong> - {{ $snippet['language'] }}  </h4>
				<div class="jumbotron">
  					<p> {{ $snippet['code'] }} </p>
				</div>

		@endforeach

	@endif


@stop