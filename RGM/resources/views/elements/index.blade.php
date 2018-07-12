@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Elements <a class="pull-right btn btn-primary btn-sm" href="elements/create">Create Element</a></h3>
        <input type="text" class="form-control col-sm-6" id="search" name="search" placeholder="Search Element">
        @include('partials.success')
        @include('partials.errors')
        <div class="panel-body">
            @if(count($elements) > 0)
                <ul class="list-group" id="list">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->id }}</td>
                                <td>{{ $element->name }}</td>
                                <td class="buttonOnCenter">
                                    <button type="button" class="btn btn-primary btn-sm"><a class="textForButton" href="/elements/{{ $element->id }}">View Element</a></button>
                                    <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/elements/{{ $element->id }}/edit">Edit</a></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <div id="pagination">
                    {{ $elements->links() }}
                </div>
            @else
                <ul class="list-group" id="list">
                    <li class="list-group-item" id="searchNotFoundText">Elements not found</li>
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
                    url     : '{{URL::to('searchElement')}}',
                    data    : {'searchElement':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                        document.getElementById('pagination').innerHTML = '';
                    }
                });
            });
        });
    </script>
@endsection