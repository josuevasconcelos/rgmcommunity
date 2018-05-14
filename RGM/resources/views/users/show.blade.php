<?php
    $roles = \App\Role::all();
?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <div class="panel-heading">{{ $user->name }}</div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($roles as $role)
                    @if($user->role_id == $role->id)
                        <li class="list-group-item">Email: {{ $user->email }}</li>
                        <li class="list-group-item">Age: {{ $user->age }}</li>
                        <li class="list-group-item">Address: {{ $user->address }}</li>
                        <li class="list-group-item">Cellphone Number: {{ $user->cellphoneNumber }}</li>
                        <li class="list-group-item">Country: {{ $user->country }}</li>
                        <li class="list-group-item">Community RGM: {{ $user->communityRGM }}</li>
                        <li class="list-group-item">Type Of Patient: {{ $user->typeOfPatient }}</li>
                        <li class="list-group-item">Status: {{ $user->status }}</li>
                        <li class="list-group-item">Other Information: {{ $user->otherInformation }}</li>
                        <li class="list-group-item">Role: {{ $role->description }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endsection