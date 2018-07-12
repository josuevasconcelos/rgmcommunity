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
        document.getElementById('btnPreviewTemplate').style.display = "none";
        document.getElementById('btnSave').style.display = "inline";
        document.getElementById('createTemplateContent').innerHTML = table;
    }

    function createTemplateInstructions(){
        swal({
            title: "Instructions",
            text: "1. Choose the components for your project and don't leave anything in blank \n\n" +
            "2. After choose the template, the template will be drawn and you can drag the elements to the template's boxes. Don't leave any box without an element. \n\n" +
            "3. If you want to delete an element from the box, just double-click that box and confirm that you want to delete the element. \n\n" +
            "4. Once you have sure that your project is finished, click the 'Generate Information' button. \n\n" +
            "5. To finish creating your project, click the 'Save' button.",
        });
    }
}