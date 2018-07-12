<?php
    $roles = \App\Role::all();
    $functionalities = \App\Functionality::all();
    $functionalitiesroles = \App\FunctionalityRole::paginate(5);
?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Associations <a class="pull-right btn btn-primary btn-sm" href="functionalitiesroles/create">Create Association</a></h3>
        <input type="text" class="form-control col-sm-5" id="search" name="search" placeholder="Search Association by Functionality">
        @include('partials.success')
        @include('partials.errors')
        <div class="panel-body">
            @if(count($functionalitiesroles) > 0)
                <ul class="list-group" id="list">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Functionality</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($functionalitiesroles as $functionalityrole)
                            @foreach($functionalities as $functionality)
                                @foreach($roles as $role)
                                    @if(($functionalityrole->functionality_id == $functionality->id) && ($functionalityrole->role_id == $role->id))
                                        <tr>
                                            <td>{{ $functionalityrole->id }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td>{{ $functionality->description }}</td>
                                            <td class="buttonOnCenter">
                                                <button type="button" class="btn btn-danger btn-sm"><a class="delete" id="{{ $functionalityrole->id }}">Delete</a></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <div id="pagination">
                    {{ $functionalitiesroles->links() }}
                </div>
            @else
                <ul class="list-group" id="list">
                    <li class="list-group-item" id="searchNotFoundText">Associations not found</li>
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
                    url     : '{{URL::to('searchAssociation')}}',
                    data    : {'searchAssociation':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                        document.getElementById('pagination').innerHTML = '';
                    }
                });
            });
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).attr('id');

            if(confirm("Are you sure you want to delete this association?")){
                $.ajax({
                    method : "get",
                    url    : '{{URL::to('deleteAssociation')}}',
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

