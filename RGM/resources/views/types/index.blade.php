@extends('layouts.sidebar')

@section('content')
    @include('partials.errors')
    @include('partials.success')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Types <a class="pull-right btn btn-primary btn-sm" href="types/create">Create Type</a></h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Type">
        <div class="panel-body">
            <ul class="list-group" id="list">
                @foreach($types as $type)
                    <li class="list-group-item">{{ $type->description }}
                        <a href="/types/{{ $type->id }}/edit">Edit</a>
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
                    url     : '{{URL::to('searchType')}}',
                    data    : {'searchType':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                    }
                });
            });
        });
    </script>
@endsection