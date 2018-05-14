@extends('layouts.sidebar')

@section('content')
<div class="panel panel-primary col-md-6 col-lg-9">
    <h3 class="title">Manage Functionalities <a class="pull-right btn btn-primary btn-sm" href="functionalities/create">Create Functionality</a></h3>
    <div class="panel-body">
        <ul class="list-group">
            @foreach($functionalities as $functionality)
                <li class="list-group-item">{{ $functionality->description }}
                    <a href="/functionalities/{{ $functionality->id }}">View Details</a> |
                    <a href="/functionalities/{{ $functionality->id }}/edit">Edit</a>
            @endforeach
        </ul>
    </div>
</div>
@endsection