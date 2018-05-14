@extends('layouts.app')

@section('sidebar')
    <!--<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
           </div>
    </div>-->

    <?php
        $user = Auth::user();
        $roles = \App\Role::all();
        $functionalities = \App\Functionality::all();
    ?>

    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <div class="sidenav">
        @foreach($roles as $role)
            @if($user->role_id == $role->id)
                @foreach($role->functionalities as $functionality)
                    <a href="{{ $functionality->url }}">{{ $functionality->description }}</a>
                @endforeach
            @endif
        @endforeach
    </div>

    <div class="main">
        @yield('content')
    </div>

@endsection