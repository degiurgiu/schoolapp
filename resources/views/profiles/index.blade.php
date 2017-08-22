@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-10 col-md-offset-1">
                <a href='{{ route('profiles.create') }}'  class="btn btn-default">New Profiles </a>
                
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Profils</h3></div>
                    <div class="panel-heading">Page {{ $profiles->currentPage() }} of {{ $profiles->lastPage() }}</div>
                    @foreach($profiles as $profile)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('profiles.show', $profile->id ) }}"><b>{{ $profile->profils }}</b><br>
                                    <p class="teaser">
                                       {{  str_limit($profile->description, 100) }} {{-- Limit teaser to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                    <div class='operations'>
                       
                        <h4>Operations</h4>
                    <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['profiles.destroy', $profile->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    <hr/>
                    <hr/>
                    </div>
                    @endforeach
                    </div>
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
                    @endforeach
                    </div>
                    <div class="text-center">
                        
                    </div>
                </div>
            </div>
        </div>
@endsection