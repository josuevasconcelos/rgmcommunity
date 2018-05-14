@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Templates <a class="pull-right btn btn-primary btn-sm" href="templates/create">Create Template</a></h3>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($templates as $template)
                    <li class="list-group-item"><a>{{ $template->name }}</a>
                        <a href="/templates/{{ $template->id }}">View Details</a> |
                        <a href="/templates/{{ $template->id }}/edit">Edit</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection