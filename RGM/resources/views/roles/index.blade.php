@extends('layouts.sidebar')

@section('content')
<div class="panel panel-primary col-md-6 col-lg-9">
    <h3 class="title">Manage Roles</h3>
    <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Role">
    <div class="panel-body">
        <ul class="list-group" id="list">
            @foreach($roles as $role)
                <li class="list-group-item"><a href="/roles/{{ $role->id }}"/>{{ $role->id }} - {{ $role->description }}</li>
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
                url     : '{{URL::to('searchRole')}}',
                data    : {'searchRole':$value},
                success : function (data){
                    document.getElementById('list').innerHTML = data;
                }
            });
        });
    });
</script>
@endsection