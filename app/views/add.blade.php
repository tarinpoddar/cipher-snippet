@extends('_master')

@section('title')
	Add Snippet
@stop

@section('content')


<form class="form-horizontal" method="post" name="add_snippet" action="/add">
  <fieldset>
    <legend> Make a new Code Snippet </legend>
    <div class="form-group">
      <label class="col-lg-2 control-label">Title</label>
      <div class="col-lg-10">
        <input type="text" name="title" class="form-control" id="inputEmail" placeholder="Title">
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label"> Programming Language </label>
      <div class="col-lg-10">
        <input type="text" name="language" class="form-control" id="inputEmail" placeholder="Language">
      </div>
    </div>
   

    <div class="form-group">

    	<label for="textArea" class="col-lg-2 control-label">Code</label>

    
    	
      
      <div class="col-lg-10">
        <textarea class="form-control" name="code" rows="15" id="textArea" 
        placeholder="Other people will use your code. Try and make it neat, short and generalistic"></textarea>
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
        <button class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>





	





@stop