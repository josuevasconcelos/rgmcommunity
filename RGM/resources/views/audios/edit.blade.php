@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Edit Audio</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('audios.update', [$audio->id]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="_method" value="put">

                    <div class="form-group">
                        <label for="audio-artist">Artist<span class="required">*</span></label>
                        <input placeholder="Enter artist" id="audio-artist" required name="artist" spellcheck="false" class="form-control" value="{{$audio->artist}}">
                    </div>

                    <div class="form-group">
                        <label for="audio-name">Name<span class="required">*</span></label>
                        <input placeholder="Enter name" id="audio-name" required name="name" spellcheck="false" class="form-control" value="{{$audio->name}}">
                    </div>

                    <div class="form-group">
                        <label for="audio-song">Song<span class="required">*</span></label>
                        <ul class="list-group">
                            <audio controls><source src="/uploads/audios/{{ $audio->song }}" type="audio/mpeg"></source></audio>
                        </ul>
                        <input type="file" name="song" required>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </ul>
        </div>
    </div>
@endsection