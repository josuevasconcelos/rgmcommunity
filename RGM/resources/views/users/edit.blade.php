<?php
    $roles = \App\Role::all();

?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Edit User - {{ $user->name }}</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('users.update', [$user->id]) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="_method" value="put">

                    <div class="form-group">
                        <label for="user-role_id">Role<span class="required">*</span></label>
                        <select id="user-role_id" name="role_id">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"> {{ $role->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </ul>
        </div>
    </div>
@endsection