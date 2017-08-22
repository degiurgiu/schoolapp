
@extends('layouts.app')

@section('title', '| Create a New Profile')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create Grade</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {!! Form::open(['action' => 'GradesController@store', 'route'=>'grades.store' ,'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}

        <div class="form-group">
            {{Form::label('students', 'Students')}}
              <select name="students" class="form-control studentone" id="students" required> 
                
                @foreach($students as $student)
                @if($student->role_id == 4 )
                    <option v-alue="{{$student->user_id}}">{{ $student->name }}</option>
                     @endif
              
                @endforeach  
               </select>
                 @if ($errors->has('students'))
                    <span class="help-block">
                        <strong>{{ $errors->first('students') }}</strong>
                    </span>
                @endif
        </div>
        <button type="button" class="btn btn-warning" id="getStudent">Select Student</button>
        <div id='getStudentData'></div>
        
         <div class="form-group">
            {{Form::label('courses', 'Courses')}}
              <select name="course" class="form-control coursesone" id="courses" required> 
                
                @foreach($courses as $course)
                
                    <option v-alue="{{$course->courses_id}}">{{ $course->courses }}</option>
                   
                @endforeach  
              </select>
                 @if ($errors->has('courses'))
                    <span class="help-block">
                        <strong>{{ $errors->first('courses') }}</strong>
                    </span>
                @endif 
                
         </div>
         <div class="form-group">
            {{Form::label('profils', 'Profils')}}
              <select name="profils" class="form-control coursesone" id="courses" required> 
                
                @foreach($courses as $profile)
                
                    <option v-alue="{{$profile->profile_id}}">{{ $profile->profils }}</option>
                   
                @endforeach  
              </select>
                 @if ($errors->has('profils'))
                    <span class="help-block">
                        <strong>{{ $errors->first('profils') }}</strong>
                    </span>
                @endif 
                
         </div>
       
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