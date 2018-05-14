@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="panel-heading">Manage Associations <a class="pull-right btn btn-primary btn-sm" href="functionalitiesroles/create">Create Association</a></h3>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($functionalitiesroles as $functionalityrole)
                    @foreach($functionalities as $functionality)
                        @if($functionalityrole->functionality_id == $functionality->id)
                            @foreach($functionality->roles as $role)
                                <li class="list-group-item">{{ $role->description }} - {{ $functionality->description }}
                                    <a href="functionalities/{{ $functionalityrole->id }}/edit">Edit</a></li>
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
@endsection

