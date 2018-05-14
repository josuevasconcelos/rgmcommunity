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

    <div id="mySidenav" class="sidenav" style="height: 100%;
          width: 0;
          position: fixed;
          z-index: 1;
          top: 0;
          left: 0;
          background-color: #d3d3d3;
          overflow-x: hidden;
          transition: 0.5s;
          padding-top: 60px;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="padding: 8px 8px 8px 32px;
          text-decoration: none;
          font-size: 15px;
          color: #000000;
          display: block;
          transition: 0.3s;position: absolute;
          top: 0;
          right: 25px;
          font-size: 20px;
          margin-left: 50px;">&times;</a>
        @foreach($roles as $role)
            @if($user->role_id == $role->id)
                @foreach($role->functionalities as $functionality)
                    <a href="{{ $functionality->url }}" style="padding: 8px 8px 8px 32px;
                                                                  text-decoration: none;
                                                                  font-size: 15px;
                                                                  color: #000000;
                                                                  display: block;
                                                                  transition: 0.3s;">{{ $functionality->description }}</a>
                @endforeach
            @endif
        @endforeach
    </div>

    <div id="main" style="transition: margin-left .5s;
          padding-left: 50px; padding-top: 30px;">
        <span style="font-size:15px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
        <div>
            @yield('content')
        </div>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
        }
    </script>

@endsection