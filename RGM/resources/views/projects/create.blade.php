<?php
    $audios = \App\Audio::all();
    $elements = \App\Element::all();
    $templates = \App\Template::all();
    $types = \App\Type::all();
    $difficultyLevels = \App\Difficultylevel::all();
?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Create Project <input type="button" class="pull-right btn btn-primary btn-sm" value="Instructions" id="btnCreateProjectInstructions" onclick="createProjectInstructions()"></h3>
        <div class="panel-body" id="createProjectLeftDiv">
            <ul class="list-group" id="formulary">
                <form method="POST" action="{{ route('projects.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="project-name">Name<span class="required">*</span></label>
                        <input placeholder="Enter name" id="project-name" required name="name" spellcheck="false" class="form-control col-sm-12">
                    </div>

                    <div class="form-group">
                        <label for="project-audio">Audio<span class="required">*</span></label><br>
                        <select name="audio_id" id="project-audio">
                            <option>-----</option>
                            @foreach($audios as $audio)
                                <option value="{{$audio->id}}">{{ $audio->artist}} - {{ $audio->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="project-template">Template<span class="required">*</span></label><br>
                        <select name="template_id" id="project-template">
                            <option>-----</option>
                            @foreach($templates as $template)
                                <option value="{{$template->id}}">{{ $template->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="project-type">Type<span class="required">*</span></label><br>
                        <select name="type_id" id="project-type">
                            <option>-----</option>
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{ $type->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="project-difficultyLevel">Difficulty Level<span class="required">*</span></label><br>
                        <select name="difficultylevel_id" id="project-difficultyLevel">
                            <option>-----</option>
                            @foreach($difficultyLevels as $difficultyLevel)
                                <option value="{{ $difficultyLevel->id}}">{{ $difficultyLevel->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="hiddenInputFields">

                    </div>

                    <div class="form-group">
                        <input type="button" class="btn btn-success" value="Generate Information" id="btnGenerateInformation" onclick="generateInformation()">
                        <input type="submit" class="btn btn-primary" id="btnSave" value="Save">
                    </div>

                </form>
            </ul>
        </div>
        <div id="showTemplateContent">

        </div>

        <div id="scrollElements">
            @foreach($elements as $element)
                <img src="/uploads/elements/{{ $element->image }}" ondragstart="drag(event)" id="{{ $element->id }}" value="{{ $element->image }}"style="width: 35px; height: 35px;"><br>
            @endforeach
        </div>
    </div>
    <script type="text/javascript">

        function createProjectInstructions(){
            swal({
                title: "Instructions",
                text: "1. Choose the components for your project and don't leave anything in blank. \n\n" +
                      "2. After choose the template, the template will be drawn and you can drag the elements to the template's boxes. Don't leave any box without an element. \n\n" +
                      "3. If you want to delete an element from the box, just double-click that box and confirm that you want to delete the element. \n\n" +
                      "4. Once you have sure that your project is finished, click the 'Generate Information' button. \n\n" +
                      "5. To finish creating your project, click the 'Save' button.",
            });
        }

        var numberOfColumns = '';
        var numberOfLines = '';
        var numberOfBlocks = '';

        $(document).on('change','#project-template',function(){
            $value = document.getElementById('project-template').value;
            $.ajax({
                type    : 'get',
                url     : '{{URL::to('getNumberOfColumns')}}',
                data    : {'getNumberOfColumns':$value},
                async   : false,
                success : function (data){
                    numberOfColumns = data;
                }
            });

            $.ajax({
                type    : 'get',
                url     : '{{URL::to('getNumberOfLines')}}',
                data    : {'getNumberOfLines':$value},
                async   : false,
                success : function (data){
                    numberOfLines = data;
                }
            });

            $.ajax({
                type    : 'get',
                url     : '{{URL::to('getNumberOfBlocks')}}',
                data    : {'getNumberOfBlocks':$value},
                async   : false,
                success : function (data){
                    numberOfBlocks = data;
                }
            });

            var columns = numberOfColumns;
            var lines = numberOfLines;
            var blocks = numberOfBlocks;

            var table = '';
            var tables = blocks;
            var rows = lines;
            var cols = columns;
            var box_id = 1;

            for(var t = 1; t <= tables; t++){
                table += '<table style="display: inline-block; margin: 10px;" id="tables'+ t +'">';
                for(var r = 1; r <= rows; r++){
                    table += '<tr>';
                    for(var c = 1; c <= cols; c++){
                        var position = t+""+r+""+c;
                        table += '<td ondblclick="deleteElement(this)" id="' + position + '" class="boxes" ondrop="drop(event)"  ondragover="allowDrop(event)">' + '</td>';
                        box_id++;
                    }
                    table += '</tr>';
                }
                table += '</table>';
            }
            document.getElementById('showTemplateContent').innerHTML = table;
        });

        function deleteElement(el){
            var result = confirm('Are you sure you want to delete this element?');
            if(result){
                el.innerHTML = "";
            } else {

            }
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }
        function drag(ev) {
            ev.dataTransfer.setData("Text", ev.target.id);
        }
        function drop(ev) {
            var data = ev.dataTransfer.getData("Text");
            ev.target.appendChild(document.getElementById(data).cloneNode(true));
            document.getElementById(data).setAttribute("draggable", "false");
            ev.preventDefault();
        }

        function generateInformation(){
            document.getElementById('btnGenerateInformation').onclick = function() {
                var columns = numberOfColumns;
                var lines = numberOfLines;
                var blocks = numberOfBlocks;

                var tables = blocks;
                var rows = lines;
                var cols = columns;

                var inputFields = '';
                var index = 0;

                for(var t = 1; t <= tables; t++){
                    for(var r = 1; r <= rows; r++){
                        for(var c = 1; c <= cols; c++){
                            var position = t+""+r+""+c;

                            var content1 = document.getElementById(position).innerHTML;
                            var endPoint1 = content1.length;

                            var startPoint1 = content1.search('id="');
                            var content2 = content1.substring(startPoint1, endPoint1);

                            var startPoint2 = content2.search('"');
                            var endPoint2 = content2.length;
                            var content3 = content2.substring(startPoint2, endPoint2);

                            var startPoint3 = content3.search('" ');
                            var endPoint3 = content3.search(' "');
                            var content4 = content3.substring(startPoint3, endPoint3);

                            var element_id = content4.split('"').join('');

                            inputFields += '<input type="hidden" name="block_positions[' + index.valueOf() + ']" value="' + t + '">';
                            inputFields += '<input type="hidden" name="row_positions[' + index.valueOf() + ']" value="' + r + '">';
                            inputFields += '<input type="hidden" name="col_positions[' + index.valueOf() + ']" value="' + c + '">';
                            inputFields += '<input type="hidden" name="elements_id[' + index.valueOf() + ']" value="' + element_id + '">';

                            index = index + 1;
                        }
                    }
                }
                alert('Information generated with success');
                document.getElementById('hiddenInputFields').innerHTML = inputFields;

                document.getElementById('btnGenerateInformation').style.display = "none";
                document.getElementById('btnSave').style.display = "inline";
            }
        }
    </script>
@endsection