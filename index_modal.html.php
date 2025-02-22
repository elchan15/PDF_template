    <style>
        .far {
            padding:5px;
            color:black;
            cursor: context-menu;
        }
        .far:hover {
            background-color: lightgray; /* Change this to your desired color */
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }
    </style>
    <script>
        $(document).ready(function() {

            // When the user submits the form, add a new row to the table and close the modal
            $("#modalForm").submit(function(event) {
                event.preventDefault();
                var title = $("#title").val();
                var date = $("#date").val();
                var newRow = "<tr><td>" + title + "</td><td>" + date + "</td><td><button class='deleteRow'>Delete</button></td></tr>";
                $("#myTable").append(newRow);
                $("#myModal").hide();
                $("#title").val('');
                $("#date").val('');
            });

            // Use event delegation to handle the dynamically added rows
            $("#myTable").on("click", ".deleteRow", function() {
                $(this).closest("tr").remove();
            });
        });

    </script>

<!-- The Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modalForm">
          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date">
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>