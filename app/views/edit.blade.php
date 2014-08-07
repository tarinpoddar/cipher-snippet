@extends('_master')

@section('title')
	Edit Snippet
@stop

@section('content')

  @foreach($errors->all() as $message) 

    <div class="alert alert-dismissable alert-danger">
      <strong> {{ $message }}  </strong>
    </div>

  @endforeach

<!-- js script - when entering a code snippet - remove the default tab use and make tab indent 4 spaces -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script> 
  
  $('#textbox').live('keydown', function(e) { 
  var keyCode = e.keyCode || e.which; 

  if (keyCode == 9) { 
    e.preventDefault(); 
    //alert('tab pressed');
    var val = this.value,
                start = this.selectionStart,
                end = this.selectionEnd;
            this.value = val.substring(0, start) + '\t' + val.substring(end);
            this.selectionStart = this.selectionEnd = start + 1;
  } 
});

</script>


{{ Form::model($snippet, ['method' => 'post', 'action' => ['SnippetController@postEdit', $snippet->id], 'class' => 'form-horizontal' ]) }}

  <fieldset>
    <legend> <strong> Edit: </strong> <br> {{ $snippet->title }} </legend>

      <div class="form-group">
        <label class="col-lg-2 control-label">Title</label>
      <div class="col-lg-10">
        {{ Form::text('title', $snippet->title, array('class' => 'form-control', 'id' => 'inputEmail')) }}
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label"> Programming Language </label>
      <div class="col-lg-10">
        {{ Form::text('language', $snippet->language, array('class' => 'form-control', 'id' => 'inputEmail')) }}
      </div>
    </div>

    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Code</label>
      <div class="col-lg-10">
        {{ Form::textarea('code', $snippet->code, array('class' => 'form-control', 'id' => 'textbox')) }}
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label">Tags <br> </label>
      <div class="col-lg-10">

      @for ($i = 1; $i <= count($tags); $i++)
        <?php $tag = "tag".$i;
         echo Form::text($tag, $tags[$i-1]['name'], array('class' => 'form-control', 'id' => 'tagsinput')) ?>
      @endfor

       @for ($i = count($tags) + 1; $i <=  6; $i++)
        <?php $tag = "tag".$i;
              $placeholder = "Tag ".$i;
         echo Form::text($tag, "", array('class' => 'form-control', 'id' => 'tagsinput', 'placeholder' => $placeholder)) ?>
      @endfor
      
        <span class="help-block">Choosing good tags will increase the search ranking and viewership of your snippet</span>
      </div>
    </div>
     <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </fieldset>
  
{{ Form::close() }}

@stop