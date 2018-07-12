@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <div class="title">{{ $template->name }} Information</div>
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item col-sm-4"><a class="itemBold">Number of Columns</a> - {{ $template->numberOfColumns }}</li>
                <input type="hidden" id="template-numberOfColumns" value="{{ $template->numberOfColumns }}">
                <li class="list-group-item col-sm-4"><a class="itemBold">Number of Lines</a> - {{ $template->numberOfLines }}</li>
                <input type="hidden" id="template-numberOfLines" value="{{ $template->numberOfLines }}">
                <li class="list-group-item col-sm-4"><a class="itemBold">Number of Blocks</a> - {{ $template->numberOfBlocks }}</li>
                <input type="hidden" id="template-numberOfBlocks" value="{{ $template->numberOfBlocks }}">
            </ul>
        </div>
        <div id="createTemplateContent">
            <script type="text/javascript">
                $(document).ready(function () {
                    var columns = document.getElementById('template-numberOfColumns').value;
                    var lines = document.getElementById('template-numberOfLines').value;
                    var blocks = document.getElementById('template-numberOfBlocks').value;

                    if (columns <= 0){
                        alert("Number of Columns must be greater than 0");
                    }

                    if (lines <= 0){
                        alert("Number of Lines must be greater than 0");
                    }

                    if (blocks <= 0){
                        alert("Number of Blocks must be greater than 0");
                    }

                    var table = '';
                    var tables = blocks;
                    var rows = lines;
                    var cols = columns;
                    for(var t = 1; t <= tables; t++){
                        table += '<table style="display: inline-block; margin: 10px;">';
                        for(var r = 1; r <= rows; r++){
                            table += '<tr>';
                            for(var c = 1; c <= cols; c++){
                                table += '<td class="boxes" id=""c+r+t"">' + c+r+t + '</td>';
                            }
                            table += '</tr>';
                        }
                        table += '</table>';
                    }
                    document.getElementById('createTemplateContent').innerHTML = table;
                });
            </script>
        </div>
    </div>
@endsection