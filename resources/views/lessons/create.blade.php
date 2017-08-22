
@extends('layouts.app')

@section('title', '| Create a New Lesson')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create Lesson</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {!! Form::open(['action' => 'LessonsController@store', 'route'=>'lessons.store' ,'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group {{ $errors->has('courses') ? ' has-error' : '' }}">
                <label for="courses" class="col-md-4 control-label">Course</label>
             <div class="">
                 <select name="courses" class="form-control" required>

                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->courses }}</option>
                    @endforeach  
                     @if ($errors->has('$courses'))
                        <span class="help-block">
                            <strong>{{ $errors->first('courses') }}</strong>
                        </span>
                    @endif
                </select>
             </div>
          </div>
           
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title','',['class'=>'form-control','placeholder'=> 'Title'])}} <!-- primul argument este numele fildului, al doilea este value care este liber '' deoarece este un input fild-->
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=> 'Description'])}} <!-- primul argument este numele fildului, al doilea este value care este liber '' deoarece este un input fild-->
        </div>
        <div class="form-group">
             {{Form::label('uploads_files', 'Upload files')}}
            {{Form::file('uploads_files')}}
        </div>
        <div class="form-group">
            {{Form::label('image_files', 'Image cover file')}}
            {{Form::file('image_file')}}
        </div>

        {{ Form::submit('Create Lessons', ['class' => 'btn btn-success btn-lg btn-block']) }}
        {{ Form::close() }}
        
        </div>
    </div>
@endsection
 <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>