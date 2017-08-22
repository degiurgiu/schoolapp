@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <a href='{{ route('courses.create') }}'  class="btn btn-default">New Courses </a>
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Courses</h3></div>
                    <div class="panel-heading">Page {{ $courses->currentPage() }} of {{ $courses->lastPage() }}</div>
                    @foreach($courses as $course)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{  "/courses/".$course->id  }}"><b>{{ $course->courses }}</b><br>
                                    <p class="teaser">
                                       {{  str_limit($course->description, 100) }} {{-- Limit teaser to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                    <div class='operations'>
                        
                        <h4>Operations</h4>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    <hr/>
                    <hr/>
                    </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        
                    </div>
                </div>
            </div>
        </div>
@endsection