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


<?php  include('layouts/header.php')  ?>


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


<?php  include('layouts/footer.php')  ?>