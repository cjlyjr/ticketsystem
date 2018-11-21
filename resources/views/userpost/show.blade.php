@extends('layouts.app')
@section('js')
<script type="text/javascript" rel="script" src="{{asset('/ticket/ckeditor-class/ckeditor.js')}}"></script>      

@append
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
  @if(!empty($post->ticketreply))
  <ul class="list-group ulstyle">
             
           
      @foreach($post->ticketreply as $key=>$item)
      <li class="list-group-item">
        {!!$item!!}
        @if(!Auth::guest())
        @if(Auth::user()->id==$post->user_id)
        <div>
        <a href="{{URL('/userpost/reply/'.$post->id.'/'.$key)}}" class="btn btn-primary">Reply</a> 
        {!!Form::open(['action'=>['UserPostController@delete',$post->id,$key],'method'=>'POST','class'=>'float-right'])!!}
           {{Form::hidden('_method','PUT')}}
           {{Form::submit('Delete ticket reply',['class'=>'btn btn-warning'])}}
        {!!Form::close()!!}
        </div>
        @endif
        @endif
      </li>
      @endforeach
     
    </ul>
    @else
    <p>No any replies</p>
  @endif


  <hr>
  @if(!Auth::guest())
    @if(Auth::user()->id==$post->user_id)
    <a href="{{URL('/userpost/'.$post->id)}}/edit" class="btn btn-success">Edit</a> 
    {!!Form::open(['action'=>['UserPostController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
       {{Form::hidden('_method','DELETE')}}
       {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
    {!!Form::close()!!}
    @endif
    @else
    <div id="replytd">
                    
                  
        {!! Form::open(['action' => ['UserPostController@update',$post->id],'method'=>'POST']) !!}
        
        <div class="form-group ">
            
              {{Form::label('contenlabel','Ticket content reply')}}
             
              {{Form::textarea('contentticket','',['id'=>'contentticket','class'=>'form-control', 'style'=>'width:250px;','placeholder'=>'reply ticket content'])}}
             <script type="text/javascript">  
                if (CKEDITOR.instances['contentticket']) {
                                  CKEDITOR.remove(CKEDITOR.instances['contentticket']);
                                   } else{
                                 CKEDITOR.replace( 'contentticket');
                                   }
                 
            
             </script>
             
          </div>
          {{Form::hidden('_method','PUT')}}
          {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
      {!! Form::close() !!}
  </div>
   @endif
   
   @else
   
  @endif

  
</div>

</div>

@endsection