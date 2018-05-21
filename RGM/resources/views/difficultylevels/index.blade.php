@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Difficulty Levels <a class="pull-right btn btn-primary btn-sm" href="difficultylevels/create">Create Difficulty Level</a></h3>
        <div class="panel-body">
            <ul class="list-group" id="list">
                @foreach($difficultylevels as $difficultylevel)
                    <li class="list-group-item">{{ $difficultylevel->description }}
                        <a href="/difficultylevels/{{ $difficultylevel->id }}/edit">Edit</a>
                @endforeach
            </ul>
        </div>
    </div>
@endsection