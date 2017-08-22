@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <a href='{{ route('lessons.create') }}'  class="btn btn-default">New Lessons </a>
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Lessons</h3></div>
                    <div class="panel-heading">Page {{ $lessons->currentPage() }} of {{ $lessons->lastPage() }}</div>
                    @foreach($lessons as $lesson)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('lessons.show', $lesson->id ) }}"><b>{{ $lesson->title }}</b><br>
                                    <p class="teaser">
                                       {{  str_limit($lesson->description) }} {{-- Limit teaser to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                     <div class='operations'>
                       
                        <h4>Operations</h4>
                    <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['lessons.destroy', $lesson->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    <hr/>
                    <hr/>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection