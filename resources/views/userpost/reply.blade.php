@extends('layouts.app')
@section('css')
<link href="{{ asset('css/editorstyle.css') }}" rel="stylesheet">
@append
@section('js')
<script type="text/javascript" rel="script" src="{{asset('/replyeditor/ckeditorfull/ckeditor.js')}}"></script>    
@append

@section('content')
  <h1>Reply  ticket</h1>
 
  <div>{!!$replyarray[$key]!!}</div>
 
  
{!! Form::open(['action' => ['UserPostController@postreply',$post->id,$key],'method'=>'POST']) !!}
  
  <div class="form-group">
      
        {{Form::label('contentadmin','Ticket Content')}}
        {{Form::textarea('contentadmin','',['id'=>'userreply','class'=>'form-control replystyle','placeholder'=>'ticket contentadmin'])}}
       
           <script type="text/javascript">  
             if (CKEDITOR.instances['userreply']) {
                             CKEDITOR.remove(CKEDITOR.instances['userreply']);
                              } else{
                            CKEDITOR.replace( 'userreply');
                              }
            
         
          </script>
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection