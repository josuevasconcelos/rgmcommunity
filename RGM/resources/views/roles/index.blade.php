@extends('layouts.sidebar')

@section('content')
<div class="panel panel-primary col-md-6 col-lg-9">
    <div class="panel-heading">Roles</div>
    <div class="panel-body">
        <ul class="list-group">
            @foreach($roles as $role)
                <li class="list-group-item"><a href="/roles/{{ $role->id }}"/>{{ $role->id }} - {{ $role->description }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection