@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Edit Template - {{ $template->name }} <input type="button" class="pull-right btn btn-primary btn-sm" value="Instructions" id="btnEditTemplateInstructions" onclick="editTemplateInstructions()"></h3>
        <div class="panel-body" id="createTemplateLeftDiv">
            <ul class="list-group">
                <form method="POST" action="{{ route('templates.update', [$template->id]) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="_method" value="put">

                    <div class="form-group">
                        <label for="template-name">Name<span class="required">*</span></label>
                        <input placeholder="Enter name" id="template-name" required name="name" spellcheck="false" class="form-control col-sm-12" value="{{ $template->name }}">
                    </div>

                    <div class="form-group">
                        <label for="template-numberOfColumns">Number of Columns<span class="required">*</span></label>
                        <input type="number" placeholder="Enter Number of Columns" id="template-numberOfColumns" required name="numberOfColumns" spellcheck="false" class="form-control col-sm-12" value="{{ $template->numberOfColumns }}">
                    </div>

                    <div class="form-group">
                        <label for="template-numberOfLines">Number of Lines<span class="required">*</span></label>
                        <input type="number" placeholder="Enter Number of Lines" id="template-numberOfLines" required name="numberOfLines" spellcheck="false" class="form-control col-sm-12" value="{{ $template->numberOfLines }}">
                    </div>

                    <div class="form-group">
                        <label for="template-numberOfBlocks">Number of Blocks<span class="required">*</span></label>
                        <input type="number" placeholder="Enter Number of Blocks" id="template-numberOfBlocks" required name="numberOfBlocks" spellcheck="false" class="form-control col-sm-12" value="{{ $template->numberOfBlocks }}">
                    </div>

                    <div class="form-group">
                        <input type="button" class="btn btn-success" value="Preview Template" id="btnPreviewTemplate" onclick="showTemplate()">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </ul>
        </div>
        <div id="createTemplateContent">
            <script type="text/javascript">

                function editTemplateInstructions(){
                    swal({
                        title: "Instructions",
                        text: "1. All the components of the template are already completed. \n\n" +
                              "2. If you want to edit something, do it but make sure that you don't leave anything in blank. \n\n" +
                              "3. Once you have sure that your project is finished, click the 'Preview Template' button. \n\n" +
                              "4. Once you have sure that the creating of your template is finished, click the 'Save' button.",
                    });
                }

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