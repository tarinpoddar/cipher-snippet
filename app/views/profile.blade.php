@extends('_master')

@section('title')
	{{ $live_user->name }}
@stop


@section('content')


@if (count($snippets) > 0)
	<h1> <strong> Your Snippets </strong> </h1>
@else 
	<h1> <strong> {{ $live_user->name }} </strong> </h1>	
	<h3>  You have no Snippets currently! </h3>
@endif

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

  		<?php   
		$url = '/edit/'.$snippet['id'];
		//echo $url; 
	 
		echo Form::open(array('url' => $url, 'method' => 'get', 'class' => 'button_form'));  ?>
	
    		<button type="submit" class="btn btn-primary btn-sm"> edit </button>
		{{ Form::close() }}


		<?php   
		$url = '/delete/'.$snippet['id'];
		//echo $url; 
	 
		echo Form::open(array('url' => $url, 'method' => 'get', 'class' => 'button_form'));  ?>
	
    		<button type="submit" class="btn btn-primary btn-sm"> Delete </button>
		{{ Form::close() }}


  		</div>

  		

@endforeach
	



@stop