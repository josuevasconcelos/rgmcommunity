@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Manage Associations <a class="pull-right btn btn-primary btn-sm" href="functionalitiesroles/create">Create Association</a></h3>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($functionalitiesroles as $functionalityrole)
                    @foreach($functionalities as $functionality)
                        @if($functionalityrole->functionality_id == $functionality->id)
                            @foreach($functionality->roles as $role)
                                <li class="list-group-item">{{ $role->description }} - {{ $functionality->description }}
                                    <a href="functionalitiesroles/{{ $functionalityrole->id }}/edit">Edit</a> |
                                    <a href="#" id="btnDelete" onclick="confirmDelete()">Delete</a>
                                    <form id="delete-form" action="{{ route('functionalitiesroles.destroy', [$functionalityrole->id]) }}" method="POST" style="display: none;">
                                        <input type="hidden" name="_method" value="delete">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
    <script>
        function confirmDelete(){
            document.getElementById('btnDelete').onclick = function() {
                var result = confirm('Are you sure you want to delete this Association?');
                if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();
                }
            }
        }
    </script>
@endsection

