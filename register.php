<?php
session_start();
include("server/connection.php");

if(isset($_POST["register"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if($password !== $confirmPassword) {
        header('location: register.php?error=Passwords do not match');
        exit();
    }

    // Check password length
    if(strlen($password) < 6) {
        header('location: register.php?error=Password must be at least 6 characters long');
        exit();
    }

    // Hash the password
   // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if a user with the same email already exists in the database
    $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
    $stmt1->bind_param("s", $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->fetch();
    $stmt1->close();

    // If a user already exists with this email
    if($num_rows != 0) {
        header("location: register.php?error=Email is already taken!");
        exit();
    }

    // Create a new user
    $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $password /*$hashedPassword*/);

    // Execute the insert query
    if($stmt->execute()) {
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION["user_email"] = $email;
        $_SESSION["user_name"] = $name;
        $_SESSION["logged_in"] = true;

        header("location: account.php?register_success=Registration was successful");
        exit();
    } else {
        header("location: register.php?error=Something went wrong while trying to register account");
        exit();
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
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
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
            <a class="nav-link" href="index.php">Home</a>
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
            <a href="cart.php"><box-icon name='cart-add'></box-icon></a>
            <a href="account.html"><box-icon type='solid' name='user-account'></box-icon></a>
          </li>
  
          
          
        </ul>
        
      </div>
    </div>
  </nav>
  <!--end of navbar-->


<!--Registration form-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Register</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <form action="register.php" method="post" id="register-form">
          <p style="color: red;" ><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
            <div class="form-group">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="register-name" placeholder="Name" required>
                </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" id="register-email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="register-password" placeholder="password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword" id="register-confirm-password"  placeholder="confirm-password" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn" name="register" id="register-btn" value="Register" >
            </div>

            <div class="form-group">
                <a id="login-url" href="login.php" class="btn" href="">Do you have an account? Login</a>
            </div>
        </form>
    </div>
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