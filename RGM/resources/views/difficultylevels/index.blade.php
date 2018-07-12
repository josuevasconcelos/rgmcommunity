@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Difficulty Levels <a class="pull-right btn btn-primary btn-sm" href="difficultylevels/create">Create Difficulty Level</a></h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Difficulty Level">
        @include('partials.success')
        @include('partials.errors')
        <div class="panel-body">
            @if(count($difficultylevels) > 0)
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
                        @foreach($difficultylevels as $difficultylevel)
                            <tr>
                                <td>{{ $difficultylevel->id }}</td>
                                <td>{{ $difficultylevel->description }}</td>
                                <td class="buttonOnCenter">
                                    <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/difficultylevels/{{ $difficultylevel->id }}/edit">Edit</a></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <div id="pagination">
                    {{ $difficultylevels->links() }}
                </div>
            @else
                <ul class="list-group" id="list">
                    <li class="list-group-item" id="searchNotFoundText">Difficulty levels not found</li>
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
                    url     : '{{URL::to('searchDifficultylevel')}}',
                    data    : {'searchDifficultylevel':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                        document.getElementById('pagination').innerHTML = '';
                    }
                });
            });
        });
    </script>
@endsection