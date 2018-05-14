@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Create Element</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('elements.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="element-name">Name<span class="required">*</span></label>
                        <input placeholder="Enter name" id="element-name" required name="name" spellcheck="false" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="element-image">Image<span class="required">*</span></label>
                        <input type="file" name="image" required>
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