
@extends('layouts.app')

@section('title', '| Create a New Profile')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create New Post</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {!! Form::open(['action' => 'ProfilController@store', 'route'=>'profiles.store' ,'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}

        <div class="form-group">
            {{Form::label('profils', 'Profils')}}
            {{Form::text('profils','',['class'=>'form-control','placeholder'=> 'Profils'])}} <!-- primul argument este numele fildului, al doilea este value care este liber '' deoarece este un input fild-->
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description','',['class'=>'form-control','placeholder'=> 'Description'])}} <!-- primul argument este numele fildului, al doilea este value care este liber '' deoarece este un input fild-->
        </div>

        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>

        {{ Form::submit('Create Profiles', ['class' => 'btn btn-success btn-lg btn-block']) }}
        {{ Form::close() }}
        
        </div>
    </div>

@endsection