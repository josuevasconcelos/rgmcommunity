<?php
    $functionalities = \App\Functionality::all();
    $roles = \App\Role::all();
?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Create Associations</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('functionalitiesroles.store') }}">
                    {{ csrf_field() }}

                    <label for="functionality_id">Functionality</label>

                    <select name="functionality_id" id="functionality_id">
                        @foreach($functionalities as $functionality)
                            <option value="{{$functionality->id}}">{{ $functionality->description }}</option>
                        @endforeach
                    </select>

                    <label for="role_id" style="padding-left: 20px;">Role</label>

                    <select name="role_id" id="role_id">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{ $role->description }}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </ul>
        </div>
    </div>
@endsection