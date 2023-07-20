<?php
$con = mysqli_connect("localhost", "root", "", "items") or die("Failed to connect"); // Establish database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values sent from the client-side JavaScript
    $item_one = $_POST["item-one"];
    $item_two = $_POST["item-two"];
    $item_three = $_POST["item-three"];

    // Perform any database insertion or processing you need to do
    $query = "INSERT INTO items_table (item_one, item_two, item_three) VALUES ('$item_one', '$item_two', '$item_three')";
    mysqli_query($con, $query);

    // Send a response back to the client with the added items
    $response = array(
        "item_one" => $item_one,
        "item_two" => $item_two,
        "item_three" => $item_three
    );
    echo json_encode($response);
}
