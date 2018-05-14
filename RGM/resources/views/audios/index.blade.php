@extends('layouts.app')

@section('content')
<div class="panel panel-primary col-md-6 col-lg-9">
    <div class="panel-heading">Audios</div>
    <div class="panel-body">
        <ul class="list-group">
            @foreach($audios as $audio)
                <li class="list-group-item"><a href="/audios/{{ $audio->id }}"/>{{ $audio->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection