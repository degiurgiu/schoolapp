

@extends('layouts.app')
@section('title', '| Edit Courses')
@section('content')

<h1>Edit Courses</h1>

{!! Form::open(['action' =>['CoursesController@update', $courses->id], 'method' => 'POST']) !!}
<div class="form-group">
    {{Form::label('courses', 'Courses')}}
    {{Form::text('courses',$courses->courses,['class'=>'form-control','placeholder'=> 'Courses'])}} <!-- primul argument este numele fildului, al doilea este value  care o luam din baza de date prin $post->title -->
</div>
<div class="form-group">
    {{Form::label('description', 'Description')}}
    {{Form::textarea('description',$courses->description,['class'=>'form-control','placeholder'=> 'description'])}} <!-- primul argument este numele fildului, al doilea este value care o luam din baza de date prin $post->body -->
</div>

{{Form::hidden('_method','PUT')}} <!--Ca sa putem face update trebuie prin methoda Put-->
{{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection


