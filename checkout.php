<?php

session_start();

if(!empty($_SESSION['cart']) && isset($_POST['checkout'])){

}else{
  header('location: index.php');
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


<!--checkout page-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Check Out</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <form action="server/place_order.php" method="post" id="checkout-form" >
            <div class="form-group">
                <div class="form-group checkout-small-element">
                    <label>Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
                </div>
            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group checkout-small-element">
                <label>Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
            </div>

            <div class="form-group checkout-small-element">
                <label>City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
            </div>

            <div class="form-group checkout-large-element">
                <label>Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
            </div>


            <div class="form-group checkout-btn-container">
                <p>Total amount: $ <?php echo $_SESSION['total'];  ?></p>
                <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order" >
            </div>

            <!--<div class="form-group">
                <a id="login-url" class="btn" href="">Do you have an account? Login</a>
            </div>-->
            
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