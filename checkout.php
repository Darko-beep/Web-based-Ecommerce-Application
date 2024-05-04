<?php

session_start();

if(!empty($_SESSION['cart']) ){

}else{
  header('location: index.php');
}


?>

<?php  include('layouts/header.php')  ?>


<!--checkout page-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Check Out</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <form action="./server/place_order.php" method="post" id="checkout-form" >
            <p class="text-center" style="color: red;" >
            <?php if(isset($_GET['message'])){ echo $_GET['message'];} ?></p>
            <?php if(isset($_GET['message'])){ ?>

                <a class="btn btn-primary " href="login.php"></a>

            <?php } ?>
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


<<?php  include('layouts/footer.php')  ?>