@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Projects <a class="pull-right btn btn-primary btn-sm" href="projects/create">Create Project</a></h3>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($projects as $project)
                    <li class="list-group-item"><a>{{ $project->name }}</a>
                        <a href="/projects/{{ $project->id }}">View Details</a> |
                        <a href="/projects/{{ $project->id }}/edit">Edit</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection