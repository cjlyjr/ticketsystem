@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{Auth::user()->name}}'s Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                    
                          
                <div> <p> You are logged in!</p><br>
                    <a class="btn btn-primary" href="{{asset('/userpost/create')}}">Create new ticket</a></div>
                            
                       
                    @if(count($posts)>0)
                    <table class="table table-striped">
                        
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                        <tr>
                           
                            <td><a href="{{asset('/userpost/'.$post->id)}}/edit">{{$post->title}}</a></td>
                            
                            <td><a href="{{asset('/userpost/'.$post->id)}}/edit">Edit</a></td>
                           
                            <td>{!!Form::open(['action'=>['UserPostController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                 {!!Form::close()!!} </td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                     <p>Sorry,You have no any ticket</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
