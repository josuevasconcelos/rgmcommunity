@extends('layouts.sidebar')

@section('content')
<div class="panel panel-primary col-md-6 col-lg-9">
    <h3 class="title">Manage Roles</h3>
    <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Role">
    @include('partials.success')
    @include('partials.errors')
    <div class="panel-body">
        @if(count($roles) > 0)
            <ul class="list-group" id="list">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </ul>
            <div id="pagination">
                {{ $roles->links() }}
            </div>
        @else
            <ul class="list-group" id="list">
                <li class="list-group-item" id="searchNotFoundText">Roles not found</li>
            </ul>
        @endif
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
                    document.getElementById('pagination').innerHTML = '';
                }
            });
        });
    });
</script>
@endsection