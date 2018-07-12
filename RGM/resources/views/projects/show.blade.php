<?php
    $elements = \App\Element::all();
    $projects = \App\Project::all();
    $elementsprojects = \App\ElementProject::all();
?>

@extends('layouts.sidebar')

@section('content')
    <div class="panel panel-primary col-md-6 col-lg-9">
        <h3 class="title">{{ $project->name }} Information</h3>
        <div class="panel-body" id="createTemplateLeftDiv">
            <ul class="list-group">

                <div class="form-group">
                    <label for="project-name" class="itemBold">Name</label>
                    <label id="project-name"> - {{ $project->name }}</label>
                </div>

                <div class="form-group">
                    <label for="project-difficultyLevel" class="itemBold">Difficulty Level</label>
                    <label id="project-difficultyLevel" id="1"> - {{ $project->difficultyLevel->description }}</label>
                </div>

                <div class="form-group">
                    <label for="project-type" class="itemBold">Type</label>
                    <label id="project-type"> - {{ $project->type->description }}</label>
                </div>

                <div class="form-group">
                    <label for="project-template" class="itemBold">Template</label>
                    <label id="project-template"> - {{ $project->template->name }}</label>
                    <input type="hidden" id="template-numberOfColumns" value="{{ $project->template->numberOfColumns }}">
                    <input type="hidden" id="template-numberOfLines" value="{{ $project->template->numberOfLines }}">
                    <input type="hidden" id="template-numberOfBlocks" value="{{ $project->template->numberOfBlocks }}">
                </div>


                <div class="form-group">
                    <label for="project-user"class="itemBold" >Created by</label>
                    <label id="project-user"> - {{ $project->user->name }}</label><br>
                </div>

                <div class="form-group">
                    <label for="project-audio"class="itemBold" >Audio</label>
                    <label id="project-audio"> - {{ $project->audio->name }} by {{ $project->audio->artist }}</label><br>
                    <audio controls><source src="/uploads/audios/{{ $project->audio->song }}" type="audio/mpeg"></source></audio>
                </div>

                <div class="form-group">
                    @foreach($elementsprojects as $elementproject)
                        @if($elementproject->project_id == $project->id)
                            @foreach($elements as $element)
                                @if($elementproject->element_id == $element->id)
                                    <input type="hidden" id="{{ $elementproject->block }}{{ $elementproject->line }}{{ $elementproject->column }}" value="{{ $element->image }}">
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>

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
                                var id = t + '' + r + '' + c;
                                var image = document.getElementById(id.toString()).value;
                                table += '<td class="boxes">' + '<img src="/uploads/elements/' + image + '" style="width: 35px; height: 35px;">' +'</td>';
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