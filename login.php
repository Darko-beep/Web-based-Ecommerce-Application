<?php

session_start( );  // Initialize Session data
include('server/connection.php');

/*
//PREVENT THE USER FROM REGISTERING ONCE LOGGED IN
if(isset( $_SESSION['logged_in'])){
  header("Location: account.php");
  exit;
}
*/

if(isset($_POST['login_btn'])) {

  $email  = $_POST['email'];
  $password = ($_POST['password']);

  $stmt = $conn->prepare("SELECT user_id,user_name,user_email,user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");

  $stmt->bind_param("ss", $email, $password);

  if( $stmt->execute()) {
    $stmt->bind_result($user_id,$user_name,$user_email,$user_password);
    $stmt->store_result();


    if($stmt->num_rows( ) == 1) {

     $stmt->fetch(); 

     $_SESSION["user_id"] = $user_id;
     $_SESSION["user_name"]= $user_name;
     $_SESSION["user_email"] = $user_email;
     $_SESSION["logged_in"] = true;

     header('location: account.php?login_success=logged in successfully');

    
    }else{
      header('location: login.php?error=could not verify your account');
    }

}else{
  //error
header('location: login.php?error=something went wrong');
  }
}


?>

<?php  include('layouts/header.php')  ?>


<!--Login-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <form action="login.php" id="login-form"  method="POST" >
          <p style="color: red;" class="text-center" ><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email"  class="form-control" id="login-email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="login-password" placeholder="password" required>
            </div>

            <div class="form-group">
                <input type="submit" name="login_btn" class="btn" id="login-btn" value="Login" >
            </div>

            <div class="form-group">
                <a id="register-url" class="btn" href="register.php">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</section>

<?php  include('layouts/footer.php')  ?>