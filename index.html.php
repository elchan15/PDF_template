<!DOCTYPE html>
<html>
<head>
    <title>Table Row Manipulation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php //bootsrap ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script >
        $(document).ready(function(){
            // Use event delegation to handle the dynamically added rows
            $("#myTable").on("click", ".deleteRow", function(){
                $(this).closest("tr").remove();
            });
        });
    </script>
    <?php
        include_once("index_modal.html.php");
    ?>
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background color */
        }
        .container {
            background-color: white; /* White background for the container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-height: 500px; /* Set your desired maximum height */
            overflow-y: auto; /* Add a scrollbar if content exceeds max height */
            margin-bottom: 3rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">PDF Template Table</h2>

        <table class="table table-striped table-bordered table-hover table-sm" id="myTable" border="1" cellpadding="8">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Template Name</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $tblResults;?>
            </tbody>
        </table>
        <br>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new template</button>
    </div>
    

</body>
</html>
