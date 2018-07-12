@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Create Type</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('types.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="type-description">Description<span class="required">*</span></label>
                        <input placeholder="Enter description" id="type-description" required name="description" spellcheck="false" class="form-control col-lg-5">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </ul>
        </div>
    </div>
@endsection