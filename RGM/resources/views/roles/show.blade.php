@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <div class="title">{{ $role->description }} Functionalities</div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($role->functionalities as $functionality)
                    <li class="list-group-item">{{ $functionality->description }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection