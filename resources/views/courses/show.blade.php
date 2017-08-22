

@extends('layouts.app')
@section('title', '| View Courses')

@section('content')

    <a href="/courses" class="btn btn-default">Go Back</a>
    <h2>{{$courses->courses}}</h2>
     
    <div>
     @unless ( empty($profiles->profils) )
        <p>Profiles: {{$profiles->profils}}</p>
        
        @endunless
       
        <!--<p>{$post->body}</p> cu doua { { } } nu citeste html cu una { !! $post->body!!  } citeste html din Db-->
        <p>{!!$courses->description!!}</p>
    </div>
    <hr>
    <small>Written on {{$courses->created_at}} by {{$courses->user->name}}</small>
    <hr>
    @if(!Auth::guest())
       
            <a href="/courses/{{$courses->id}}/edit" class="btn btn-default">Edit</a>


            {!!Form::open(['action'=> ['CoursesController@destroy', $courses->id], 'method'=> 'POST', 'class'=> 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete,',['class'=>'btn btn-danger'])}}

            {!!Form::close()!!}
       
    @endif
@endsection

