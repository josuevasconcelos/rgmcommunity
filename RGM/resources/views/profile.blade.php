@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 125px; height: 125px; float: left; border-radius: 50%; margin-right: 25px;">
                <h3 class="profileName">{{ $user->name }}'s Profile</h3>
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    <label>Update User Image</label><br>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection