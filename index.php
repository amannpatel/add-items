<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Items</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List of Items</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label>Item 1</label>
                                <input type="text" id="item-one" name="item-one" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Item 2</label>
                                <input type="text" id="item-two" name="item-two" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Item 3</label>
                                <input type="text" id="item-three" name="item-three" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <button type="button" id="btn-add-items" class="btn btn-warning">Add Items</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List of Added Items</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item 1</th>
                                    <th>Item 2</th>
                                    <th>Item 3</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load existing data on page load
            loadExistingData();

            $('#btn-add-items').click(function() {
                var item1 = $("#item-one").val();
                var item2 = $("#item-two").val();
                var item3 = $("#item-three").val();

                if (item1.trim() === '' || item2.trim() === '' || item3.trim() === '') {
                    alert("Please fill in all three fields.");
                    return;
                }

                // Call the function to save the values to the server
                saveValues(item1, item2, item3);
            });

            function loadExistingData() {
                $.ajax({
                    url: 'code.php',
                    type: 'GET',
                    success: function(data) {
                        // Update the table with fetched data
                        var tableBody = $("#table-body");
                        tableBody.empty(); // Clear existing table data

                        for (var i = 0; i < data.length; i++) {
                            var newRow = "<tr>" +
                                "<td>" + data[i].item_one + "</td>" +
                                "<td>" + data[i].item_two + "</td>" +
                                "<td>" + data[i].item_three + "</td>" +
                                "</tr>";
                            tableBody.append(newRow);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle any error that occurred during the AJAX request
                        console.log(xhr.responseText);
                    }
                });
            }

            function saveValues(item_one, item_two, item_three) {
                $.ajax({
                    url: 'code.php',
                    type: 'POST',
                    data: JSON.stringify({
                        "item-one": item_one,
                        "item-two": item_two,
                        "item-three": item_three
                    }),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data) {
                        // Update the table with the received data
                        var newRow = "<tr>" +
                            "<td>" + data.item_one + "</td>" +
                            "<td>" + data.item_two + "</td>" +
                            "<td>" + data.item_three + "</td>" +
                            "</tr>";
                        $("#table-body").append(newRow);
                    },
                    error: function(xhr, status, error) {
                        // Handle any error that occurred during the AJAX request
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
</body>

</html>