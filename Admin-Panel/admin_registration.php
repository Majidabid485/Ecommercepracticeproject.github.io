<?php
include('../Include/connect.php');
include('../functions/comon_function.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!----------------bootstrap css file link links----------------------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />

    <!----------------Font Awesome cdn links----------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!----------------custom css file link links----------------------->
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        
    </style>

</head>

<body>
    <div class="container">
        <h2 class="text-center mb-5 mt-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../IMG/signup-image.jpg" alt="Admin Registration Image" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" class="form-control" required />
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control" required />
                    </div>
                    <div class="form-outline mb-4">
                        <label for="admin_image" class="form-label">Admin Image</label>
                        <input type="file" id="admin_image" name="admin_image" class="form-control" required />
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control" required />
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your confirm password" class="form-control" required />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="submit" id="" name="admin_registration" value="Register" class="bg-info py-2 px-3 border-0" required />
                        <p class="small fw-bold mt-2 pt-1">Do you already have an account? <a href="admin_login.php" class="link-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['admin_registration'])) {
    $admin_name = $_POST['username'];
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];
    $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);
    $conf_admin_password = $_POST['confirm_password'];
    $admin_image = $_FILES['admin_image']['name'];
    $tmp_admin_image = $_FILES['admin_image']['tmp_name'];
    move_uploaded_file($tmp_admin_image, "./product_images/$admin_image");

    //select query
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name' or admin_email='$admin_email'";
    $select_result = mysqli_query($con, $select_query);
    $select_row = mysqli_num_rows($select_result);

    if ($select_row > 0) {
        echo "<script>alert('Username and Email already exist')</script>";
    } elseif ($admin_password != $conf_admin_password) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        //insert_query
        $insert_query = "INSERT INTO `admin_table` (admin_name,admin_email,admin_password,admin_image)
         VALUES ('$admin_name','$admin_email','$hash_password','$admin_image')";
        $sql_execute = mysqli_query($con, $insert_query);
        echo "<script>alert('Registration Successful')</script>";
    }
}



?>