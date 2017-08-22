
@extends('layouts.app')

@section('title', '| Create Courses')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1>Create Courses</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {!! Form::open(['action' => 'CoursesController@store', 'method' => 'POST']) !!}
         <div class="form-group">
            {{Form::label('profile', 'Profile')}}
              <select name="profils" class="form-control" required>  
                @foreach($profile as $profile)
                    <option value="{{ $profile->id }}">{{ $profile->profils }}</option>
                @endforeach  
                 @if ($errors->has('profils'))
                    <span class="help-block">
                        <strong>{{ $errors->first('profils') }}</strong>
                    </span>
                @endif
            </select>
        </div>
        
        <div class="form-group">
            {{Form::label('courses', 'Courses')}}
            {{Form::text('courses','',['class'=>'form-control','placeholder'=> 'Courses'])}} <!-- primul argument este numele fildului, al doilea este value care este liber '' deoarece este un input fild-->
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description','',['class'=>'form-control','placeholder'=> 'Description'])}} <!-- primul argument este numele fildului, al doilea este value care este liber '' deoarece este un input fild-->
        </div>

        {{ Form::submit('Create Profiles', ['class' => 'btn btn-success btn-lg btn-block']) }}
        {{ Form::close() }}
        
        </div>
    </div>

@endsection

