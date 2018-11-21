@extends('layouts.app')
@section('js')
<script type="text/javascript" rel="script" src="{{asset('/templateEditor/ckeditorfull/ckeditor.js')}}"></script>    
@append
@section('content')
  <h1>Update your ticket</h1>
{!! Form::open(['action' => ['UserPostController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
  <div class="form-group">
      {{Form::label('title','Title')}}
      {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'title'])}}
      
  </div>
  <div class="form-group">
      
        {{Form::label('content','Ticket Content')}}
        {{Form::textarea('content',$post->ticketcontent,['id'=>'editor1','class'=>'form-control','placeholder'=>'ticket content'])}}
       
           <script type="text/javascript">  
             if (CKEDITOR.instances['editor1']) {
                             CKEDITOR.remove(CKEDITOR.instances['editor1']);
                              } else{
                            CKEDITOR.replace( 'editor1');
                              }
            
         
          </script>
    </div>
    <div class="form-group">
      <p>Update your attachment files here</p>
    {{Form::file('fileimg')}}
     
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection