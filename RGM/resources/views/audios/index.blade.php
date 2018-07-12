@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Audios <a class="pull-right btn btn-primary btn-sm" href="audios/create">Create Audio</a></h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Audio">
        @include('partials.success')
        @include('partials.errors')
        <div class="panel-body">
            @if(count($audios) > 0)
                <ul class="list-group" id="list">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Artist</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($audios as $audio)
                            <tr>
                                <td>{{ $audio->id }}</td>
                                <td>{{ $audio->artist }}</td>
                                <td>{{ $audio->name }}</td>
                                <td class="buttonOnCenter">
                                    <button type="button" class="btn btn-primary btn-sm"><a class="textForButton" href="/audios/{{ $audio->id }}">Listen Audio</a></button>
                                    <button type="button" class="btn btn-success btn-sm"><a class="textForButton" href="/audios/{{ $audio->id }}/edit">Edit</a></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </ul>
                <div id="pagination">
                    {{ $audios->links() }}
                </div>
            @else
                <ul class="list-group" id="list">
                    <li class="list-group-item" id="searchNotFoundText">Audios not found</li>
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
                    url     : '{{URL::to('searchAudio')}}',
                    data    : {'searchAudio':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                        document.getElementById('pagination').innerHTML = '';
                    }
                });
            });
        });
    </script>
@endsection