@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Types <a class="pull-right btn btn-primary btn-sm" href="types/create">Create Type</a></h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Type">
        @include('partials.success')
        @include('partials.errors')
        <div class="panel-body" id="list">
            @if(count($types) > 0)
            <ul class="list-group">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $type)
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->description }}</td>
                                <td class="buttonOnCenter">
                                    <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/types/{{ $type->id }}/edit">Edit</a></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </ul>
            <div id="pagination">
                {{ $types->links() }}
            </div>
            @else
                <ul class="list-group" id="error">
                    <li class="list-group-item" id="searchNotFoundText">Types not found</li>
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
                    url     : '{{URL::to('searchType')}}',
                    data    : {'searchType':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                        document.getElementById('pagination').innerHTML = '';
                    }
                });
            });
        });
    </script>
@endsection