

@extends('layouts.app')
@section('title', '| Edit Profiles')
@section('content')

<h1>Edit Profils</h1>

{!! Form::open(['action' =>['ProfilController@update', $profiles->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
<div class="form-group">
    {{Form::label('profils', 'Profils')}}
    {{Form::text('profils',$profiles->profils,['class'=>'form-control','placeholder'=> 'Profils'])}} <!-- primul argument este numele fildului, al doilea este value  care o luam din baza de date prin $post->title -->
</div>
<div class="form-group">
    {{Form::label('description', 'Description')}}
    {{Form::textarea('description',$profiles->description,['class'=>'form-control','placeholder'=> 'description'])}} <!-- primul argument este numele fildului, al doilea este value care o luam din baza de date prin $post->body -->
</div>
<div class="form-group">
    {{Form::file('cover_image')}}
</div>
{{Form::hidden('_method','PUT')}} <!--Ca sa putem face update trebuie prin methoda Put-->
{{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection

