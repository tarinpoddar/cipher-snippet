@extends('_master')

@section('title')
  Sign up
@stop

@section('content')


{{ Form::open(array('url' => url('/signup'), 'class'=>'form-horizontal')) }}

  @foreach($errors->all() as $message) 

    <div class="alert alert-dismissable alert-danger">
      <strong> {{ $message }}  </strong>
    </div>

  @endforeach

  <fieldset>
    <legend>Sign Up</legend>

    <div class="form-group">
      <label class="col-lg-2 control-label">Name</label>
      <div class="col-lg-10">
        
        {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'name')) }}
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
       
        {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'Email')) }}

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
        <button type="submit" class="btn btn-primary">Sign up</button>
      </div>
    </div>
  </fieldset>
{{ Form::close() }}




@stop