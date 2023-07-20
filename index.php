<?php
require 'code.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List of Items</title>
    <!-- Link for Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- Link for JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <!-- FORM TO ADD ITEMS -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List of Items
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">

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
                                <button type="button" value="Add Items" id="btn-add-items" name="btn-add-items" class="btn btn-warning">Add Itemes </button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLE TO DISPLAY ITEMS -->
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
                            <tbody>
                                <tr>
                                    <!-- <td id="data-one"></td>
                                    <td id="data-two"></td>
                                    <td id="data-three"></td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#btn-add-items').click(function() {
                var item1 = $("#item-one").val();
                var item2 = $("#item-two").val();
                var item3 = $("#item-three").val();

                // Call the function to save the values to the server
                saveValues(item1, item2, item3);
            });

            function saveValues(item_one, item_two, item_three) {
                $.ajax({
                    url: 'code.php',
                    type: 'POST',
                    data: {
                        "item-one": item_one,
                        "item-two": item_two,
                        "item-three": item_three
                    },
                    success: function(data) {
                        console.log(data);

                        // Parse the JSON response
                        var response = JSON.parse(data);

                        // Update the table with the received data
                        var newRow = "<tr>" +
                            "<td>" + response.item_one + "</td>" +
                            "<td>" + response.item_two + "</td>" +
                            "<td>" + response.item_three + "</td>" +
                            "</tr>";
                        $("tbody").append(newRow);
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