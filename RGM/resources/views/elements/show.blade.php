@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Element - {{ $element->name }}</h3>
        <div class="panel-body">
            <ul class="list-group">
                <img src="/uploads/elements/{{ $element->image }}" style="width: 125px; height: 125px; float: left; margin-right: 25px;">
            </ul>
        </div>
    </div>
@endsection