function generateTemplate(){
    document.getElementById('btnGenerateTemplate').onclick = function(){
        var columns = document.getElementById("project_template_numberOfColumns").value;
        var lines = document.getElementById("project_template_numberOfLines").value;
        var blocks = document.getElementById("project_template_numberOfBlocks").value;

        var table = '';
        var tables = blocks;
        var rows = lines;
        var cols = columns;
        for(var t = 1; t <= tables; t++){
            table += '<table style="display: inline-block; margin: 10px;">';
            for(var r = 1; r <= rows; r++){
                table += '<tr>';
                for(var c = 1; c <= cols; c++){
                    table += '<td class="boxes">' + '</td>';
                }
                table += '</tr>';
            }
            table += '</table><br>';
        }
        document.getElementById('showTemplateContent').innerHTML = table;
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