@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Edit Element</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('elements.update', [$element->id]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="_method" value="put">

                    <!--
                    <div class="form-group">
                        <label for="element-name">Name<span class="required">*</span></label>
                        <input placeholder="Enter name" id="element-name" required name="name" spellcheck="false" class="form-control" value="{{$element->name}}">
                    </div> -->

                    <div class="form-group">
                        <label for="element-image">Image<span class="required">*</span></label>
                        <ul class="list-group">
                            <img src="/uploads/elements/{{ $element->image }}" style="width: 125px; height: 125px; float: left; margin-right: 25px;">
                        </ul>
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