@extends('layouts.app')
@section('content')
  <div class="card">
      <div class="card-title">
          <h1>{{$post->title}}</h1>
      </div>
    <div class="card-body">
    
      
      
  <div>{!!$post->ticketcontent!!}</div>
  <hr>
  <p><small>Written on {{$post->created_at}}</small></p>
<hr>
  <a href="{{asset('userpost')}}" class="card-link">Go back</a>
  
  {!! Form::open(['action' => 'UserPostController@store','method'=>'POST']) !!}
  
  <div class="form-group">
      
        {{Form::label('Write your ticket  here','','ticket')}}
        {{Form::textarea('area2','',['id'=>'ticker1','name'=>'area2','class'=>'form-control','placeholder'=>'Ticket content reply'])}}
        
          
    </div>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
</div>
</div>

@endsection