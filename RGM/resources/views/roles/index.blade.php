@extends('layouts.sidebar')

@section('content')
<div class="panel panel-primary col-md-6 col-lg-9">
    <h3 class="title">Manage Roles</h3>
    <div class="panel-body">
        <ul class="list-group">
            @foreach($roles as $role)
                <li class="list-group-item"><a href="/roles/{{ $role->id }}"/>{{ $role->id }} - {{ $role->description }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection