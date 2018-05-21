<?php
    $roles = \App\Role::all();
?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Users</h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search User">
        <div class="panel-body">
            <ul class="list-group" id="list">
                @foreach($users as $user)
                    <li class="list-group-item">{{ $user->name }}
                        <a href="/users/{{ $user->id }}">View Details</a> |
                        <a href="/users/{{ $user->id }}/edit">Edit</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                $value = $(this).val();
                $.ajax({
                    type    : 'get',
                    url     : '{{URL::to('searchUser')}}',
                    data    : {'searchUser':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                    }
                });
            });
        });
    </script>
@endsection
