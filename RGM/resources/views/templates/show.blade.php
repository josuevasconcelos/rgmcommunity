@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <div class="title">{{ $template->name }} Information</div>
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item col-sm-4"><a class="itemBold">Number of Columns</a> - {{ $template->numberOfColumns }}</li>
                <li class="list-group-item col-sm-4"><a class="itemBold">Number of Lines</a> - {{ $template->numberOfLines }}</li>
                <li class="list-group-item col-sm-4"><a class="itemBold">Number of Blocks</a> - {{ $template->numberOfBlocks }}</li>
            </ul>
        </div>
    </div>
@endsection