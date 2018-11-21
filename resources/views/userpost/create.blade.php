@extends('layouts.app')
@section('js')
<script type="text/javascript" rel="script" src="{{asset('/templateEditor/ckeditorfull/ckeditor.js')}}"></script>    
@append
@section('content')
  <h1>Create new Ticket</h1>
{!! Form::open(['action' => ['UserPostController@store'],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
  <div class="form-group">
      {{Form::label('title','Title')}}
      {{Form::text('title','',['class'=>'form-control','placeholder'=>'title'])}}
      
  </div>
  <div class="form-group">
      
        {{Form::label('content','Ticket Content')}}
        {{Form::textarea('content','',['id'=>'editor','class'=>'form-control','placeholder'=>'ticket content'])}}
       
        <script type="text/javascript">  
           if (CKEDITOR.instances['editor']) {
                             CKEDITOR.remove(CKEDITOR.instances['editor']);
                              } else{
                            CKEDITOR.replace( 'editor');
                              }
            
       
        </script>
    </div>
  <div class="form-group">
    <p>Add your attachment files here</p>
  {{Form::file('fileimg')}}
   
  </div>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection