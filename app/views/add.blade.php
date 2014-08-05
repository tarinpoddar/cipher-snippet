@extends('_master')

@section('title')
	Add Snippet
@stop

@section('content')

  @foreach($errors->all() as $message) 

    <div class="alert alert-dismissable alert-danger">
      <strong> {{ $message }}  </strong>
    </div>

  @endforeach


{{ Form::open(array('url' => url('/add'), 'class'=>'form-horizontal', 'method' => 'post')) }}
  <fieldset>
    <legend> Make a new Code Snippet </legend>
    <div class="form-group">
      <label class="col-lg-2 control-label">Title</label>
      <div class="col-lg-10">
        {{ Form::text('title', null, array('class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'Title')) }}
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label"> Programming Language </label>
      <div class="col-lg-10">
       {{ Form::text('language', null, array('class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'Language')) }}
      </div>
    </div>
   

    <div class="form-group">
    	<label for="textArea" class="col-lg-2 control-label">Code</label>
      <div class="col-lg-10">
        {{ Form::textarea('code', null, array('class' => 'form-control', 'rows' => '15', 'id' => 'textbox',
            'placeholder' => 'Other people will use your code. Try and make it neat, short and generalistic')) }}
      </div>
    </div>

    
       
      


    <div class="form-group">
      <label class="col-lg-2 control-label">Tags <br> </label>

      <div class="col-lg-10">
        <input type="text" name="tag1" class="form-control" id="tagsinput" placeholder="Tag 1">
        <input type="text" name="tag2" class="form-control" id="tagsinput" placeholder="Tag 2">
        <input type="text" name="tag3" class="form-control" id="tagsinput" placeholder="Tag 3">
        <input type="text" name="tag4" class="form-control" id="tagsinput" placeholder="Tag 4">
        <input type="text" name="tag5" class="form-control" id="tagsinput" placeholder="Tag 5">
        <input type="text" name="tag6" class="form-control" id="tagsinput" placeholder="Tag 6">
        <span class="help-block">Choosing good tags will increase the search ranking and viewership of your snippet</span>

      </div>
    </div>

 	



    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </div>
  </fieldset>
{{ Form::close() }}





	





@stop