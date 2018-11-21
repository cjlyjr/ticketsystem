@extends('layouts.app')
@section('content')

<a href="{{asset('/')}}" class="btn btn-primary">Go back</a>
  <div class="card">
      @if(!empty($post))
    <div class="card-title">
          <h1>{{$post->title}}</h1>
      </div>
  <div class="card-body">
    
      
      
  <div>{!!$post->ticketcontent!!}</div>
  <hr>
  <p><small>Ticket post on {{$post->created_at}}</small></p>
  <hr>
  <div>{!!$post->ticketreply!!}</div>
  @if(Auth::guest())
  

   @endif
   @else
   
  @endif

  
</div>

</div>

@endsection