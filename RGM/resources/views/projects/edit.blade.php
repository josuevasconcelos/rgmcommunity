<?php
    $audios = \App\Audio::all();
    $elements = \App\Element::all();
    $elementsprojects = \App\ElementProject::all();
    $templates = \App\Template::all();
    $types = \App\Type::all();
    $difficultyLevels = \App\Difficultylevel::all();
?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">Edit Project - {{ $project->name }} <input type="button" class="pull-right btn btn-primary btn-sm" value="Instructions" id="btnEditProjectInstructions" onclick="editProjectInstructions()"></h3>
        <div class="panel-body" id="createTemplateLeftDiv">
            <ul class="list-group">
                <form method="POST" action="{{ route('projects.update', [$project->id]) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="_method" value="put">

                    <div class="form-group">
                        <label for="project-name">Name<span class="required">*</span></label>
                        <input placeholder="Enter name" id="project-name" required name="name" spellcheck="false" class="form-control col-sm-12" value="{{ $project->name }}">
                    </div>

                    <div class="form-group">
                        <label for="project-audio">Audio<span class="required">*</span></label><br>
                        <select name="audio_id" id="project-audio">
                            @foreach($audios as $audio)
                                @if($audio->id == $project->audio_id)
                                    <option selected value="{{$audio->id}}">{{ $audio->artist}} - {{ $audio->name }}</option>
                                @else
                                    <option value="{{$audio->id}}">{{ $audio->artist}} - {{ $audio->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <!--<label for="project-template">Template<span class="required">*</span></label><br>
                        <select name="template_id" id="project-template">
                            @foreach($templates as $template)
                                @if($template->id == $project->template_id)
                                    <option selected value="{{$template->id}}">{{ $template->name }}</option>
                                @else
                                    <option value="{{$template->id}}">{{ $template->name }}</option>
                                @endif
                            @endforeach-->
                            <input type="hidden" name="template_id" value="{{ $project->template_id }}">
                            <input type="hidden" id="template-numberOfColumns" value="{{ $project->template->numberOfColumns }}">
                            <input type="hidden" id="template-numberOfLines" value="{{ $project->template->numberOfLines }}">
                            <input type="hidden" id="template-numberOfBlocks" value="{{ $project->template->numberOfBlocks }}">
                        <!--</select>-->
                    </div>

                    <div class="form-group">
                        <label for="project-type">Type<span class="required">*</span></label><br>
                        <select name="type_id" id="project-type">
                            @foreach($types as $type)
                                @if($type->id == $project->type_id)
                                    <option selected value="{{$type->id}}">{{ $type->description }}</option>
                                @else
                                    <option value="{{$type->id}}">{{ $type->description }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="project-difficultyLevel">Difficulty Level<span class="required">*</span></label><br>
                        <select name="difficultylevel_id" id="project-difficultyLevel">
                            @foreach($difficultyLevels as $difficultyLevel)
                                @if($difficultyLevel->id == $project->difficultylevel_id)
                                    <option selected value="{{ $difficultyLevel->id}}">{{ $difficultyLevel->description }}</option>
                                @else
                                    <option value="{{ $difficultyLevel->id}}">{{ $difficultyLevel->description }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div id="hiddenInputFields">

                    </div>

                    <div class="form-group">
                        @foreach($elementsprojects as $elementproject)
                            @if($elementproject->project_id == $project->id)
                                @foreach($elements as $element)
                                    @if($elementproject->element_id == $element->id)
                                        <input type="hidden" id="{{ $elementproject->block }}{{ $elementproject->line }}{{ $elementproject->column }}" value="{{ $element->image }}" class="{{ $element->id }}">
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>

                    <div class="form-group">
                        <input type="button" class="btn btn-success" value="Generate Information" id="btnGenerateInformation" onclick="generateInformation()">
                        <input type="submit" class="btn btn-primary" id="btnSave" value="Save">
                    </div>

                </form>
            </ul>
        </div>

        <div id="showTemplateContent">
            <script type="text/javascript">

                function editProjectInstructions(){
                    swal({
                        title: "Instructions",
                        text: "1. All the components of the project are already completed. \n\n" +
                              "2. If you want to edit something, do it but make sure that you don't leave anything in blank. \n\n" +
                              "3. If you want to delete an element from the box, just double-click that box and confirm that you want to delete the element. \n\n" +
                              "4. Once you have sure that your project is finished, click the 'Generate Information' button. \n\n" +
                              "5. To finish editing your project, click the 'Save' button.",
                    });
                }

                var numberOfColumns = '';
                var numberOfLines = '';
                var numberOfBlocks = '';

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
                                var id = t + '' + r + '' + c;
                                var position = t+""+r+""+c;
                                var image = document.getElementById(id.toString()).value;
                                var element_id = document.getElementById(id.toString()).className;
                                table += '<td ondblclick="deleteElement(this)" id="' + 'position_' + position + '" class="boxes" ondrop="drop(event)"  ondragover="allowDrop(event)">' + '<img id="' + element_id + '" src="/uploads/elements/' + image + '" style="width: 35px; height: 35px;">' +'</td>';
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
                        var columns = document.getElementById('template-numberOfColumns').value;
                        var lines = document.getElementById('template-numberOfLines').value;
                        var blocks = document.getElementById('template-numberOfBlocks').value;

                        var tables = blocks;
                        var rows = lines;
                        var cols = columns;

                        var inputFields = '';
                        var index = 0;

                        for(var t = 1; t <= tables; t++){
                            for(var r = 1; r <= rows; r++){
                                for(var c = 1; c <= cols; c++){
                                    var position = t+""+r+""+c;

                                    var content1 = document.getElementById('position_' + position).innerHTML;
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

                                    alert(element_id);

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
        </div>

        <div id="scrollElements">
            @foreach($elements as $element)
                <img src="/uploads/elements/{{ $element->image }}" ondragstart="drag(event)" id="{{ $element->id }}" value="{{ $element->image }}"style="width: 35px; height: 35px;"><br>
            @endforeach
        </div>
    </div>
@endsection