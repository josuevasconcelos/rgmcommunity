@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">{{ $audio->artist }} - {{ $audio->name }}</h3>
        <div class="panel-body">
            <ul class="list-group">
                <audio controls><source src="/uploads/audios/{{ $audio->song }}" type="audio/mpeg"></source></audio>
            </ul>
        </div>
    </div>
@endsection