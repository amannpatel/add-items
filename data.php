<?php
require 'code.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $query = "SELECT * FROM items_table";
    $query_run = mysqli_query($con, $query);

    $response = mysqli_fetch_assoc($query_run);

    echo json_encode($response);
}
