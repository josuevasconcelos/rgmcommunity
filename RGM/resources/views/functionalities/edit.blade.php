@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="panel-heading">Functionalities</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('functionalities.update', [$functionality->id]) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="_method" value="put">

                    <div class="form-group">
                        <label for="functionality-description">Description<span class="required">*</span></label>
                        <input placeholder="Enter description" id="functionality-description" required name="description" spellcheck="false" class="form-control" value="{{ $functionality->description }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </ul>
        </div>
    </div>
@endsection