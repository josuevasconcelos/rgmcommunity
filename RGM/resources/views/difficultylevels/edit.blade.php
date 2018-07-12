@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Edit Difficulty Level - {{ $difficultylevel->description }}</h3>
        <div class="panel-body">
            <ul class="list-group">
                <form method="POST" action="{{ route('difficultylevels.update', [$difficultylevel->id]) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="_method" value="put">

                    <div class="form-group">
                        <label for="difficultylevel-description">Description<span class="required">*</span></label>
                        <input placeholder="Enter description" id="difficultylevel-description" required name="description" spellcheck="false" class="form-control col-lg-5" value="{{ $difficultylevel->description }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </ul>
        </div>
    </div>
@endsection