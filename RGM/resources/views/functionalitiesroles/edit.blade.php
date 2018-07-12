<?php
$functionalities = \App\Functionality::all();
$roles = \App\Role::all();
?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Edit Associations</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('functionalitiesroles.update', [$functionalityRole->id]) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="_method" value="put">

                    <label for="functionality_id">Functionality</label>

                    <select name="functionality_id" id="functionality_id">
                        @if($functionalityRole->functionality_id == $functionality->id)
                            <option> {{$functionality->description}}</option>
                                @foreach($functionalities as $functionality)
                                    <option value="{{$functionality->id}}">{{ $functionality->description }}</option>
                                @endforeach
                        @endif
                    </select>

                    <label for="role_id" style="padding-left: 20px;">Role</label>

                    <select name="role_id" id="role_id">
                        @if($functionalityRole->role_id == $role->id)
                            <option> {{$role->description}}</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{ $role->description }}</option>
                                @endforeach
                        @endif
                    </select>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </ul>
        </div>
    </div>
@endsection