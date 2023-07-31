<?php
include('../Include/connect.php');
include('../functions/comon_function.php');
@session_start(); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-commerce Website - User Login</title>
    <!----------------Font Awesome cdn links----------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!----------------bootstrap css file link links----------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!----------------Custom css file link links----------------------->
    <link rel="stylesheet" href="./CSS/style.css">

</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">
                    <!-- username field -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" name="user_username" placeholder="Enter your username" class="form-control" autocomplete="off" required />
                    </div>
                    <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" name="user_password" placeholder="Enter your password" class="form-control" autocomplete="off" required />
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have na account?
                            <a href="user_registration.php" class="text-danger">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!-- php code start here -->
<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_ip = getIPAddress();

    $select_query = "SELECT * FROM `users_table` WHERE username='$user_username'";
    $select_result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($select_result);
    $select_row = mysqli_fetch_array($select_result);

    //cart items
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart = mysqli_query($con, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);
    // $select_row = mysqli_fetch_array($select_result);
    // $cart_item_count = $select_row['cart_item_count'];
    // if ($row_count > 0) {}

    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;
        if (password_verify($user_password, $select_row['user_password'])) {
            // echo "<script>alert('Login Successfully')</script>";
            if ($row_count==1 and $row_count_cart==0) {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login Successfully')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            }else{
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login Successfully')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}


?>