

@extends('layouts.app')
@section('title', '| Edit Lessons')
@section('content')

<h1>Edit lesson</h1>

{!! Form::open(['action' =>['LessonsController@update', $lessons->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
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
            {{Form::text('title',$lessons->title,['class'=>'form-control','placeholder'=> 'Title'])}} <!-- primul argument este numele fildului, al doilea este value care este liber '' deoarece este un input fild-->
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description',$lessons->description,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=> 'Description'])}} <!-- primul argument este numele fildului, al doilea este value care este liber '' deoarece este un input fild-->
        </div>
        <div class="form-group">
             {{Form::label('uploads_files', 'Upload files')}}
            {{Form::file('uploads_files')}}
        </div>
        <div class="form-group">
            {{Form::label('image_files', 'Image cover file')}}
            {{Form::file('image_file')}}
        </div>
{{Form::hidden('_method','PUT')}} <!--Ca sa putem face update trebuie prin methoda Put-->
{{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection

