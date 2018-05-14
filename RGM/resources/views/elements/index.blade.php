@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Elements <a class="pull-right btn btn-primary btn-sm" href="elements/create">Create Element</a></h3>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($elements as $element)
                    <li class="list-group-item">{{ $element->name }}
                        <a href="/elements/{{ $element->id }}">View Details</a> |
                        <a href="/elements/{{ $element->id }}/edit">Edit</a>
                @endforeach
            </ul>
        </div>
    </div>
@endsection