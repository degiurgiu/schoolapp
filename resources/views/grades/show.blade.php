

@extends('layouts.app')
@section('title', '| View Profile')

@section('content')

    <a href="/profiles" class="btn btn-default">Go Back</a>
    <h2>{{$profiles->profils}}</h2>
     <img style="width: 100%;" src="/storage/cover_images/{{$profiles->cover_image}}">
    <div>
        <!--<p>{$post->body}</p> cu doua { { } } nu citeste html cu una { !! $post->body!!  } citeste html din Db-->
        <p>{!! $profiles->description !!}</p>
    </div>
    <hr>
    <small>Written on {{$profiles->created_at}} by </small>
    <hr>
    @if(!Auth::guest())
       
            <a href="/profiles/{{$profiles->id}}/edit" class="btn btn-default">Edit</a>


            {!!Form::open(['action'=> ['ProfilController@destroy', $profiles->id], 'method'=> 'POST', 'class'=> 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete,',['class'=>'btn btn-danger'])}}

            {!!Form::close()!!}
       
    @endif
@endsection
