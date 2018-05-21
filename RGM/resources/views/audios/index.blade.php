@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Audios <a class="pull-right btn btn-primary btn-sm" href="audios/create">Create Audio</a></h3>
        <input type="text" class="form-control col-sm-4" id="search" name="search" placeholder="Search Audio">
        <div class="panel-body">
            <ul class="list-group" id="list">
                @foreach($audios as $audio)
                    <li class="list-group-item">{{ $audio->artist }} - {{ $audio->name }}
                        <a href="/audios/{{ $audio->id }}">View Details</a> |
                        <a href="/audios/{{ $audio->id }}/edit">Edit</a></li>
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
                    url     : '{{URL::to('searchAudio')}}',
                    data    : {'searchAudio':$value},
                    success : function (data){
                        document.getElementById('list').innerHTML = data;
                    }
                });
            });
        });
    </script>
@endsection