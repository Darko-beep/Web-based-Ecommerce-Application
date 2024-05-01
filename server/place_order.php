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
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Check if the prepared statement is successful
    if ($stmt !== false) {
        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
        if ($stmt->execute()) {
            $order_id = $stmt->insert_id;

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

//get products from the cart 
$_SESSION['cart'];
foreach($_SESSION['cart'] as $key => $value ){
    $product = $_SESSION['cart'][$key];
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];
    $product_image = $product['product_image'];
    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];


    $stmt1 = $conn->prepare("INSERT INTO order_items ( order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date ) 
                     VALUES  (?,?,?,?,?,?,?,?)");
    
    $stmt1->bind_param("iissiiis",$order_id,$product_id, $product_name,$product_image, $product_price ,$product_quantity,$user_id,$order_date);

    $stmt1->execute();

}

//remove everthing from the cart 



//inform user whether everything is fine  or not
header('location: ../payment.php?order_status=Order Placed Successfully');
//header('Location: ../payment.php?order_status=order%20placed%20successfully');
