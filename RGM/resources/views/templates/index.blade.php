@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Templates <a class="pull-right btn btn-primary btn-sm" href="templates/create">Create Template</a></h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Template">
        @include('partials.success')
        @include('partials.errors')
        <div class="panel-body">
            @if(count($templates) > 0)
                <ul class="list-group" id="list">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Blocks</th>
                            <th>Columns</th>
                            <th>Lines</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($templates as $template)
                            <tr>
                                <td>{{ $template->id }}</td>
                                <td>{{ $template->name }}</td>
                                <td>{{ $template->numberOfBlocks }}</td>
                                <td>{{ $template->numberOfColumns }}</td>
                                <td>{{ $template->numberOfLines }}</td>
                                <td class="buttonOnCenter">
                                    <button type="button" class="btn btn-primary btn-sm"><a class="textForButton" href="/templates/{{ $template->id }}">View Template</a></button>
                                    <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/templates/{{ $template->id }}/edit">Edit</a></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <div id="pagination">
                    {{ $templates->links() }}
                </div>
            @else
                <ul class="list-group" id="list">
                    <li class="list-group-item" id="searchNotFoundText">Templates not found</li>
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
                    url     : '{{URL::to('searchTemplate')}}',
                    data    : {'searchTemplate':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                        document.getElementById('pagination').innerHTML = '';
                    }
                });
            });
        });
    </script>
@endsection