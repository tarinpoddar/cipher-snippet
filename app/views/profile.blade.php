@extends('_master')


@section('content')

<h1 id = "mainheading"> USER </h1>

	@foreach ($collection as $snippet)
		{{ $snippet['title'] }}
	@endforeach
	



@stop