

@extends('layouts.app')
@section('title', '| View Lessons')

@section('content')
<!--<div style="
     background: url('/storage/image_file/{{$lessons->image_file}}');
    background-size: 800px 600px;
    background-repeat: no-repeat;
    background-position: center;">-->

    <a href="/lessons" class="btn btn-default">Go Back</a>
    <h2>{{$lessons->title}}</h2>
   <div>
         @foreach ($courses as $course)
        @if($lessons->id == $course->lesson_id)
        <h3>Courses:{{$course->courses}}</h3>
        @endif
         
       @endforeach
      
    </div>
     <img style="width: 800px;" src="/storage/image_file/{{$lessons->image_file}}">
    <div>
        <!--<p>{$post->body}</p> cu doua { { } } nu citeste html cu una { !! $post->body!!  } citeste html din Db-->
        <p>{!! $lessons->description !!}</p>
        <a href="/storage/uploads_files/{{$lessons->uploads_files}}">Resorce name {{$lessons->uploads_files}} </a>
    </div>
    <hr>
    <small>Written on {{$lessons->created_at}} by {{$lessons->user->name}}</small>
    <hr>
    
    
    @if(!Auth::guest())
       
            <a href="/lessons/{{$lessons->id}}/edit" class="btn btn-default">Edit</a>


            {!!Form::open(['action'=> ['LessonsController@destroy', $lessons->id], 'method'=> 'POST', 'class'=> 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete,',['class'=>'btn btn-danger'])}}

            {!!Form::close()!!}
       
    @endif
<!--</div>-->

@endsection
