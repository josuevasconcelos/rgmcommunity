@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-11 col-lg-11">
        <h3 class="title">Manage Projects <a class="pull-right btn btn-primary btn-sm" href="projects/create">Create Project</a></h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Project">
        @include('partials.success')
        @include('partials.errors')
        <div class="panel-body">
            @if(count($projects) > 0)
                <ul class="list-group" id="list">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Template</th>
                            <th>Difficulty Level</th>
                            <th>Type</th>
                            <th>Created by</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->template->name }}</td>
                                <td>{{ $project->difficultyLevel->description }}</td>
                                <td>{{ $project->type->description }}</td>
                                <td>{{ $project->user->name }}</td>
                                <td class="buttonOnCenter">
                                    <button type="button" class="btn btn-primary btn-sm"><a class="textForButton" href="/projects/{{ $project->id }}">View Project</a></button>
                                    <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/projects/{{ $project->id }}/edit">Edit</a></button>
                                    <button type="button" class="btn btn-danger btn-sm"><a class="delete" id="{{ $project->id }}">Delete</a></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <div id="pagination">
                    {{ $projects->links() }}
                </div>
            @else
                <ul class="list-group" id="list">
                    <li class="list-group-item" id="searchNotFoundText">Projects not found</li>
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
                    url     : '{{URL::to('searchProject')}}',
                    data    : {'searchProject':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                        document.getElementById('pagination').innerHTML = '';
                    }
                });
            });
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).attr('id');

            if(confirm("Are you sure you want to delete this project?")){
                $.ajax({
                    method : "get",
                    url    : '{{URL::to('deleteProject')}}',
                    data   : {id : id},
                    success: function (data) {
                        alert(data);
                        location.reload();
                    }
                });
            }
            else {
                return false;
            }
        });
    </script>
@endsection