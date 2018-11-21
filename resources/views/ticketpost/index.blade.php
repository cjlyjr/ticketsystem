@extends('layouts.appticket')
@section('content')
  
      <h3>Ticket List</h3>
      
       
    
      @if(count($posts)>0)
     <ul class="list-group">
        
        @foreach($posts as $post)
        <li class="list-group-item">
           <div><h3><a href="{{asset('/userpost')}}/{{$post->id}}">{{$post->title}}</a></h3></div>
           <div class="distance"><small>Ticket post on {{$post->created_at}} by  {{$post->user->name}}</small></div>
          
        
        @if($post->ticketreply!==null)
        <div class="container replycolor" id="replycolor">
                {!!$post->ticketreply!!}
              </div>
           @else
            <div class="noreply">The ticket no reply</div>
          @endif
            
           @if(Auth::guest())
           <div>
           <div  class="float-right btn btn-success replybt"><a href="{{asset('/userpost')}}/{{$post->id}}">Ticket reply</a></div>
        @endif
        </li>
          @endforeach
       
    </ul>
        {{$posts->links()}}
      @else
       <p>No any ticket now</p>
      @endif
      
@endsection


             
           


