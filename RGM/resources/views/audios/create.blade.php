@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Create Audio</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('audios.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="audio-artist">Artist<span class="required">*</span></label>
                        <input placeholder="Enter artist" id="audio-artist" required name="artist" spellcheck="false" class="form-control col-lg-5">
                    </div>

                    <div class="form-group">
                        <label for="audio-name">Name<span class="required">*</span></label>
                        <input placeholder="Enter name" id="audio-name" required name="name" spellcheck="false" class="form-control col-lg-5">
                    </div>

                    <div class="form-group">
                        <label for="audio-song">Song<span class="required">*</span></label>
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