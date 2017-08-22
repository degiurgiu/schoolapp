@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                  <a href='{{ route('grades.create') }}'  class="btn btn-default">New Grades </a>
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Grades</h3></div>
                    <div class="panel-heading">Page {{ $grades->currentPage() }} of {{ $grades->lastPage() }}</div>
                    @foreach($grades as $grade)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('grades.show', $grade->id ) }}"><b>{{ $grade->grade }}</b><br>
                                    <p class="teaser">
                                       {{  str_limit($grade->$grades) }} {{-- Limit teaser to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                    <div class='operations'>
                        
                        <h4>Operations</h4>
                    <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['grades.destroy', $grade->id] ]) !!}
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