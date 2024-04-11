<?php

session_start();
include('server/connection.php');

if(!isset($_SESSION["logged_in"])){
header('location: login.php');
exit;
}

if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset( $_SESSION['logged_in']);
    unset( $_SESSION['user_email']);
    unset( $_SESSION['user_name']);

    header('location: login.php');
    exit;
  }
}

if(isset($_POST['change_password'])){
          $password = $_POST['password'];
          $confirmPassword =  $_POST['confirmPassword'];
          $user_email = $_SESSION['user_email'];

          // Check if passwords match
          if($password !== $confirmPassword) {
            header('location: account.php?error=Passwords do not match');
            
        // Check password length
        }else if(strlen($password) < 6) {
            header('location: account.php?error=Password must be at least 6 characters long');

            //no errors
        }else{
          $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
          $stmt -> bind_param("ss",$password,$user_email);

          if($stmt->execute()){
              header('location: account.php?message=password has been updated');
        }else{
          header('location: account.php?error=password could not be updated');
      }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="boxicons.min.css">
    

    <title>MushFarms Home</title>
</head>
<body>
    
    <!--navbar beginning-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
      <div class="container-fluid">
        <!--a class="navbar-brand" href="#">Mushfarms</a> -->
        <img class="logo" src="/assets/images/logo.jpg" alt="logo">
        
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="shop.html">Shop</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>
    
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
    
            <li class="nav-item">
              <a href="cart.html"><box-icon name='cart-add'></box-icon></a>
              <a href="account.html"><box-icon type='solid' name='user-account'></box-icon></a>
            </li>
    
            
            
          </ul>
          
        </div>
      </div>
    </nav>
    <!--end of navbar-->


<!--Account-->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <p class="text-center" style="color: green;" ><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; } ?></p>
        <p class="text-center" style="color: green;" ><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; } ?></p>
        
            <h3 class="font-weight-bold">Account info</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Name: <span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} ?></span></p>
                <p>Email: <span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];} ?></span></p>
                <p><a href="#orders" id="order-btn">Your orders</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>  
        </div>
        
        <div class="col-lg-6 col-md-12 col-md-12">
            <form action="account.php" id="account-form" method="post" > 
              <p class="text-center" style="color: red;" ><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
              <p class="text-center" style="color: green;" ><?php if(isset($_GET['message'])){ echo $_GET['message']; } ?></p>
                <h3>Change Password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Enter your password" required>
                </div>

                <div class="form-group">
                    <input type="submit" value="change Password" name="change_password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>

    </div>
</section>


<!--Orders-->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Products</th>
            <th>Date</th>
          
        </tr>

        <tr>
            <td>
                <div class="product-info">
                    <img src="/assets/images/mushpack.jpg" alt="">

                    <div>
                        <p class="mt-3">Mushrooms</p>
                    </div>

                </div>
            </td>

            <td>
               <span>2024/03/09</span>
            </td>

          
        
        </tr>
    </table>










</section>


<!--footer-->
<footer class="mt-5 py-5">
    <div class="row container mx-auto pt-5">
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <img class="logo" src="assets/images/logo.jpg" alt="logo">
       
        <p class="pt-3">Mushfam was founded by Zachariah Abubakar and Rashida Moro in the year 2019 and
          registered as a partnership business with the Registrar general’s department in 2020. The
          business to change its status to a limited liability company as it upscales its production capacity.
          The company began its sales and production activity in 2020. </p>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Featured</h5>
        <ul class="text-uppercase">
          <li><a href="">Shop</a></li>
          <li><a href="">Blog</a></li>
          <li><a href="">Contact Us</a></li>
          <li><a href="">Social Media</a></li>
        </ul>
      </div>

      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Contact Us</h5>
        <div>
          <h6 class="text-uppercase">Address</h6>
          <p>1234 street name, city</p>
        </div>
        <div>
          <h6 class="text-uppercase">Phone</h6>
          <p>1234567890</p>
        </div>
        <div>
          <h6 class="text-uppercase">Email</h6>
          <p>info@email.com</p>
        </div>       
      </div>
      
      
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">instagram</h5>    
          <div class="row">
            <img src="./assets/images/mushroomn=benefits 1.jpg" alt="" class="img-fluid w-25 h-10 m-2">
            <img src="/assets/images/mushroom_growing.jpg" alt="" class="img-fluid w-25 h-10 m-2">
            <img src="/assets/images/mushroom_benefits.jpg" alt="" class="img-fluid w-25 h-10 m-2">
            <img src="/assets/images/organic_mushrooms.jpg" alt="" class="img-fluid w-25 h-10 m-2">
            <img src="/assets/images/Oyster Mushroom 1.jpg" alt="" class="img-fluid w-25 h-10 m-2">
            <img src="/assets/images/mushroom_growing.jpg" alt="" class="img-fluid w-25 h-10 m-2">
          </div>
      </div>
    </div>

    <div class="copyright mt-5">
      <div class="row container mx-auto">
        <div class="col-lg-3 col-md-5 col-sm-12 md-4">
          <img src="/assets/images/visa.jpg" alt="visa">
        </div>
        <div class="col-lg-3 col-md-5 col-sm-12 md-4 text-nowrap mb-2">
          <p>MushFarms @ 2021 All Rights Reserved.</p>
        </div>
        
        <div class="col-lg-3 col-md-5 col-sm-12 md-4">
          <a href=""><box-icon type='logo' name='facebook-circle'></box-icon></a>
          <a href=""><box-icon type='logo' name='twitter'></box-icon></a>
          <a href=""><box-icon type='logo' name='linkedin'></box-icon></a>
          <a href=""><box-icon name='instagram' type='logo' ></box-icon></a>
        </div>
      
      </div>
    </div>
</footer>
<!--end of footer-->




  
  
  <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>