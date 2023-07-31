<?php
include('../Include/connect.php');
include('../functions/comon_function.php');
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-commerce Website - User Registration</title>
    <!----------------Font Awesome cdn links----------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!----------------bootstrap css file link links----------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!----------------Custom css file link links----------------------->
    <link rel="stylesheet" href="./CSS/style.css">

</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- username field -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" name="user_username" placeholder="Enter your username" class="form-control" autocomplete="off" required />
                    </div>
                    <!-- Email field -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" name="user_email" placeholder="Enter your email" class="form-control" autocomplete="off" required />
                    </div>
                    <!-- user image field -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" name="user_image" class="form-control" required />
                    </div>
                    <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" name="user_password" placeholder="Enter your password" class="form-control" autocomplete="off" required />
                    </div>
                    <!-- confirm password field -->
                    <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" name="conf_user_password" placeholder="Enter your confirm password" class="form-control" autocomplete="off" required />
                    </div>
                    <!-- Address field -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" name="user_address" placeholder="Enter your address" class="form-control" autocomplete="off" required />
                    </div>
                    <!-- Contact field -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" name="user_contact" placeholder="Enter your contact number" class="form-control" autocomplete="off" required />
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have na account?
                            <a href="user_login.php" class="text-danger">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<!-- php code start here to insert the user into database -->
<?php
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $tmp_user_image = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    //select query
    $select_query = "SELECT * FROM `users_table` WHERE username='$user_username' or user_email='$user_email'";
    $select_result = mysqli_query($con, $select_query);
    $select_row = mysqli_num_rows($select_result);

    if ($select_row > 0) {
        echo "<script>alert('Username and Email already exist')</script>";
    } elseif ($user_password != $conf_user_password) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        //insert_query
        move_uploaded_file($tmp_user_image, "./users-images/$user_image");
        $insert_query = "INSERT INTO `users_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile)
         VALUES ('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
        $sql_execute = mysqli_query($con, $insert_query);
    }

    // if ($sql_execute) {
    //     echo "<script>alert('Data inserted successfully')</>";
    // }else{
    //     die(mysqli_error($con));
    // }

    //selecting cart items 
    $select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart_result = mysqli_query($con, $select_cart_items);
    $select_cart_row = mysqli_num_rows($select_cart_result);
    if ($select_cart_row > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

?>