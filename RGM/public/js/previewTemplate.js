function showTemplate(){
    document.getElementById('btnPreviewTemplate').onclick = function(){
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
        for(var t = 0; t < tables; t++){
            table += '<table style="display: inline-block; margin: 10px;">';
            for(var r = 0; r < rows; r++){
                table += '<tr>';
                for(var c = 1; c <= cols; c++){
                    table += '<td class="boxes">' + '</td>';
                }
                table += '</tr>';
            }
            table += '</table>';
        }
        document.getElementById('createTemplateContent').innerHTML = table;
    }
}