@extends('layouts.app')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <div class="panel-heading">{{ $audio->name }}</div>
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item">{{ $audio->artist }} - {{ $audio->duration }}</li>
            </ul>
        </div>
    </div>
@endsection