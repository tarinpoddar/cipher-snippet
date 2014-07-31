@extends('_master')


@section('content')


{{ Form::open(array('url' => url('/login'), 'class'=>'form-horizontal')) }}

  <fieldset>
    <legend>Login</legend>

    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password"> 
      </div>
    </div>

   
    
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </div>
  </fieldset>
{{ Form::close() }}




@stop