@extends('_master')


@section('content')


@if (count($snippets) > 0)
	<h1> <strong> {{ $live_user->name }}'s Snippets </strong> </h1>
@else 
	<h1> <strong> {{ $live_user->name }} </strong> </h1>	
	<h3>  You have no Snippets currently! </h3>
@endif

@foreach ($snippets as $snippet)

<div class="jumbotron">
  <h2> <strong> {{ $snippet['title'] }} </strong> - {{ $snippet['language'] }}  </h2>
  <p> {{ $snippet['code'] }} </p>
  
</div>

@endforeach
	



@stop