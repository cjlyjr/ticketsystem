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
  <hr>
  
    @if(Auth::guest())
    <div id="replytd">
                    
                  
        {!! Form::open(['action' => ['TicketPostController@update',$post->id],'method'=>'POST']) !!}
        
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
   @endif
  
   
  

  
</div>

</div>

@endsection