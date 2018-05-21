@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Create Functionality</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('functionalities.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="functionality-description">Description<span class="required">*</span></label>
                        <input placeholder="Enter description" id="functionality-description" required name="description" spellcheck="false" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="functionality-url">URL<span class="required">*</span></label>
                        <input placeholder="Enter URL" id="functionality-url" required name="url" spellcheck="false" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </ul>
        </div>
    </div>
@endsection