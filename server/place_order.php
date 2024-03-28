<?php

include('connection.php');

if(isset($_POST['place_order'])){
    //get user info and store into the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION[''];
    $order_status = "on_hold";
    $user_id = 1;
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,user_date)
                    VALUES(?,?,?,?,?,?,?);");

    $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);
    $stmt->execute();

    $order_id = $stmt->insert_id;

    echo $order_id;




    //get products from cart (from session)






    //issue new order and store order info in database





    //store each single item in order_items database


    //inform user whether everything is fine or there is a problem






    


}







