<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Custom PDF</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Customize Your PDF</h2>
    
    <form id="pdfForm">
        <label>PDF Title:</label>
        <input type="text" id="pdfTitle" name="pdf_title" required><br><br>

        <label>Text:</label>
        <input type="text" name="text" required><br><br>

        <label>Position X:</label>
        <input type="number" name="x" value="10"><br><br>

        <label>Position Y:</label>
        <input type="number" name="y" value="10"><br><br>

        <label>Width:</label>
        <input type="number" name="width" value="0"><br><br>

        <label>Height:</label>
        <input type="number" name="height" value="10"><br><br>

        <label>Border:</label>
        <select name="border">
            <option value="0">No Border</option>
            <option value="1">With Border</option>
        </select><br><br>

        <label>Alignment:</label>
        <select name="align">
            <option value="L">Left</option>
            <option value="C">Center</option>
            <option value="R">Right</option>
        </select><br><br>

        <label>Multi-Cell:</label>
        <input type="checkbox" name="multi" value="1"><br><br>

        <label>Font:</label>
        <select name="font">
            <option value="Arial">Arial</option>
            <option value="Courier">Courier</option>
            <option value="Times">Times</option>
        </select><br><br>

        <label>Font Size:</label>
        <input type="number" name="size" value="12"><br><br>

        <label>Bold:</label>
        <input type="checkbox" name="bold"><br><br>

        <label>Italic:</label>
        <input type="checkbox" name="italic"><br><br>

        <label>Underline:</label>
        <input type="checkbox" name="underline"><br><br>

        <label>Text Color:</label>
        <input type="color" name="text_color" value="#000000"><br><br>

        <label>Background Color:</label>
        <input type="color" name="bg_color" value="#ffffff"><br><br>

        <button type="button" id="saveText">Save Text</button>
        <button type="button" id="generatePdf">Generate PDF</button>
    </form>

    <script>
        $(document).ready(function(){
            $("#saveText").click(function(){
                var title = $("#pdfTitle").val().trim();
                if (title === "") {
                    alert("Please enter a PDF title!");
                    return;
                }

                var formData = $("#pdfForm").serialize();
                $.post("pdf_Save.php", formData, function(response){
                    alert(response);
                });
            });

            $("#generatePdf").click(function(){
                var title = $("#pdfTitle").val().trim();
                if (title === "") {
                    alert("Please enter a PDF title!");
                    return;
                }

                var pdfUrl = "pdf_Generate.php?pdf_title=" + encodeURIComponent(title);
                window.open(pdfUrl, "PDF Preview", "width=800,height=600");
            });
        });
    </script>
</body>
</html>
