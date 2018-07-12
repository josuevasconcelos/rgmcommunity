@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-12 col-lg-12">
        <h3 class="title">Create Template <input type="button" class="pull-right btn btn-primary btn-sm" value="Instructions" id="btnCreateTemplateInstructions" onclick="createTemplateInstructions()"></h3>
        <div class="panel-body" id="createTemplateLeftDiv">
            <ul class="list-group">
                <form method="POST" action="{{ route('templates.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="template-name">Name<span class="required">*</span></label>
                        <input placeholder="Enter name" id="template-name" required name="name" spellcheck="false" class="form-control col-sm-12">
                    </div>

                    <div class="form-group">
                        <label for="template-numberOfColumns">Number of Columns<span class="required">*</span></label>
                        <input type="number" placeholder="Enter Number of Columns" id="template-numberOfColumns" required name="numberOfColumns" spellcheck="false" class="form-control col-sm-12">
                    </div>

                    <div class="form-group">
                        <label for="template-numberOfLines">Number of Lines<span class="required">*</span></label>
                        <input type="number" placeholder="Enter Number of Lines" id="template-numberOfLines" required name="numberOfLines" spellcheck="false" class="form-control col-sm-12">
                    </div>

                    <div class="form-group">
                        <label for="template-numberOfBlocks">Number of Blocks<span class="required">*</span></label>
                        <input type="number" placeholder="Enter Number of Blocks" id="template-numberOfBlocks" required name="numberOfBlocks" spellcheck="false" class="form-control col-sm-12">
                    </div>

                    <div class="form-group">
                        <input type="button" class="btn btn-success" value="Preview Template" id="btnPreviewTemplate" onclick="showTemplate()">
                        <input type="submit" class="btn btn-primary" value="Save" id="btnSave">
                    </div>
                </form>
            </ul>
        </div>
        <div id="createTemplateContent">
            <script type="text/javascript" src="{{ asset('js/previewTemplate.js') }}"></script>
            <script>
                function createTemplateInstructions(){
                    swal({
                        title: "Instructions",
                        text: "1. Choose the name, number of columns, number of lines and number of blocks to your template. \n\n" +
                              "2. Make sure that you don't leave anything in blank. \n\n" +
                              "3. After this, click on the 'Preview Template' button. \n\n" +
                              "4. To save the template you just edited, click the 'Save' button.",
                    });
                }
            </script>
        </div>
    </div>
@endsection