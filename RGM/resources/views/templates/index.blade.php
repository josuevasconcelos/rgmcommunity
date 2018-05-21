@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Templates <a class="pull-right btn btn-primary btn-sm" href="templates/create">Create Template</a></h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Template">
        <div class="panel-body">
            <ul class="list-group" id="list">
                @foreach($templates as $template)
                    <li class="list-group-item">{{ $template->name }}
                        <a href="/templates/{{ $template->id }}">View Details</a> |
                        <a href="/templates/{{ $template->id }}/edit">Edit</a>
                    </li>
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
                    url     : '{{URL::to('searchTemplate')}}',
                    data    : {'searchTemplate':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                    }
                });
            });
        });
    </script>
@endsection