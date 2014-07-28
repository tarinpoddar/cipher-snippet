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
    <ul class="nav navbar-nav">
      <li class="active"><a href="/add"> Add a Snippet </a></li>
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li class="dropdown-header">Dropdown header</li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
    </ul>
    <form class="navbar-form navbar-left">
      <input type="text" class="form-control col-lg-8" placeholder="Search">
    </form>
    <ul class="nav navbar-nav navbar-right">

      <li><a href="/signup">Sign up</a></li>

      <li><a href="/logout">Log Out</a></li>

    </ul>
  </div>
</div>

    @if(Session::get('flash_message'))

      <div class="alert alert-dismissable alert-warning">
           <h3> {{ Session::get('flash_message') }} </h3>
      </div>

    @endif

<div class="container">


		
		@yield('content')
		
		@yield('body')

</div>	



	
</body>

</html>