<!doctype html>
<html>
<head>

	<title>@yield('title','Cipher Snippet')</title>
	
	<link rel="stylesheet" href="/styles/cosmo.css" type="text/css">
	<link rel="stylesheet" href="/styles/style.css" type="text/css">
	
	@yield('head')
	
</head>

<body>



	<div class="navbar navbar-default">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">Cipher Snippet</a>
  </div>
  <div class="navbar-collapse collapse navbar-responsive-collapse">
    
    {{ Form::open(array('url' => url('/query'), 'class'=>'navbar-form navbar-left', 'method' => 'post')) }}
      <input type="text" name="query" class="form-control col-lg-8" placeholder="Search">
    {{ Form::close() }}
    <ul class="nav navbar-nav">
     <li class="active"> <a href="/snippets"> View All Snippets </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">

      @if (Auth::check())
        <li class="active"><a href="/add"> Add a Snippet </a></li>
        <li> <a href="/profile"> {{ Auth::user()->name }} </a> </li>  
      @else
        <li><a href="/signup">Sign up</a></li>
      @endif

      @if(Auth::check())
        <li><a href="/logout">Log Out</a></li>
      @else
        <li><a href="/login">Login</a></li>
      @endif   

    </ul>
  </div>
</div>

    @if(Session::get('flash_message'))

      <div class="alert alert-dismissable alert-warning">
         <h3> <strong> {{ Session::get('flash_message') }}  </strong> </h3>
      </div>

    @endif

<div class="container">


		
		@yield('content')
		
		@yield('body')

</div>	



	
</body>

</html>