<?php
    $roles = \App\Role::all();
?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="panel-heading">Users</h3>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($users as $user)
                    @foreach($roles as $role)
                        @if($user->role_id == $role->id)
                            <li class="list-group-item">{{ $user->name }} - {{ $role->description }}
                                <a href="/users/{{ $user->id }}">View Details</a> |
                                <a href="/users/{{ $user->id }}/edit">Edit</a>
                        @endif
                    @endforeach
                @endforeach

            </ul>
        </div>
    </div>
@endsection