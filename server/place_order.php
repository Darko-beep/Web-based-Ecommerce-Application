<?php
session_start();
include 'connection.php';

if (isset($_POST['place_order'])) {
    //get user info and store into the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $user_id = 1;
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Check if the prepared statement is successful
    if ($stmt !== false) {
        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
        if ($stmt->execute()) {
            $order_id = $stmt->insert_id;
            echo $order_id;
        } else {
            // Error executing the SQL statement
            echo "Error executing SQL statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Error preparing the SQL statement
        echo "Error preparing SQL statement: " . $conn->error;
    }
}

