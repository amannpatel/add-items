<?php
$con = mysqli_connect("localhost", "root", "", "items") or die("Failed to connect"); // Establish database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $postData = file_get_contents('php://input');
    // Decode the JSON data
    $data = json_decode($postData, true);

    // Get the values sent from the client-side JavaScript
    $item_one = $data["item-one"];
    $item_two = $data["item-two"];
    $item_three = $data["item-three"];

    // Perform any database insertion or processing you need to do
    $query = "INSERT INTO items_table (item_one, item_two, item_three) VALUES ('$item_one', '$item_two', '$item_three')";
    mysqli_query($con, $query);

    // Send the response back to the client with the added items
    $response = array(
        "item_one" => $item_one,
        "item_two" => $item_two,
        "item_three" => $item_three
    );
    echo json_encode($response);
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Fetch all data from the items_table on GET request
    $fetch_query = "SELECT * FROM items_table";
    $result = mysqli_query($con, $fetch_query);

    // Prepare an array to store the fetched data
    $items_data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $items_data[] = $row;
    }

    // Send the fetched data as JSON response
    header('Content-Type: application/json');
    echo json_encode($items_data);
}
