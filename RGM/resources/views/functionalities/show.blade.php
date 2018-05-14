@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <div class="panel-heading">{{ $functionality->description }} Information</div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($functionality->roles as $role)
                    <li class="list-group-item">{{ $role->description }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection