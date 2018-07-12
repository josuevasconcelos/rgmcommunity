@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Functionalities <a class="pull-right btn btn-primary btn-sm" href="functionalities/create">Create Functionality</a></h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Functionality">
        @include('partials.success')
        @include('partials.errors')
        <div class="panel-body">
            @if(count($functionalities) > 0)
                <ul class="list-group" id="list">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($functionalities as $functionality)
                            <tr>
                                <td>{{ $functionality->id }}</td>
                                <td>{{ $functionality->description }}</td>
                                <td class="buttonOnCenter">
                                    <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/functionalities/{{ $functionality->id }}/edit">Edit</a></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <div id="pagination">
                    {{ $functionalities->links() }}
                </div>
            @else
                <ul class="list-group" id="list">
                    <li class="list-group-item" id="searchNotFoundText">Functionalities not found</li>
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
                    url     : '{{URL::to('searchFunctionality')}}',
                    data    : {'searchFunctionality':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                        document.getElementById('pagination').innerHTML = '';
                    }
                });
            });
        });
    </script>
@endsection