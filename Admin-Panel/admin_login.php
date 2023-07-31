<?php
include('../Include/connect.php');
include('../functions/comon_function.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!----------------bootstrap css file link links----------------------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />

    <!----------------Font Awesome cdn links----------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!----------------custom css file link links----------------------->
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        body {
            overflow: hidden;
        }
    </style>

</head>

<body>
    <div class="container">
        <h2 class="text-center mb-5 mt-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../IMG/signin-image.jpg" alt="Admin Registration Image" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username"
                         class="form-control" required/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                         class="form-control" required/>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="submit" id="" name="admin_login" value="Login"
                         class="bg-info py-2 px-3 border-0" required/>
                         <p class="small fw-bold mt-2 pt-1">Don't you have an account? <a href="./admin_registration.php" class="link-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>


<!-- php code start here -->
<?php
if (isset($_POST['admin_login'])) {
    $admin_name = $_POST['username'];
    $admin_password = $_POST['password']; 

    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name'";
    $select_result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($select_result);
    $select_row = mysqli_fetch_array($select_result);

    if ($row_count > 0) {
        $_SESSION['admin_username'] = $admin_name;
        if (password_verify($admin_password, $select_row['admin_password'])) {
            // echo "<script>alert('Login Successfully')</script>";
            if ($row_count==1) {
                $_SESSION['admin_username'] = $admin_name;
                echo "<script>alert('Login Successfully')</script>";
                echo "<script>window.open('./index.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}


?>