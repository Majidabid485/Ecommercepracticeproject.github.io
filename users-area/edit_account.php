<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `users_table` WHERE username='$user_session_name'";
    $select_result = mysqli_query($con, $select_query);
    $row = mysqli_fetch_array($select_result);
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_email = $row['user_email'];
    $user_address = $row['user_address'];
    $user_mobile = $row['user_mobile'];
}
if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $user_img = $_FILES['user_img']['name'];
    $user_img_tmp = $_FILES['user_img']['tmp_name'];
    move_uploaded_file($user_img_tmp, "./users-images/$user_img");
    if ($user_img) {
        $img_sql=" user_image='$user_img', ";
    }else{
        $img_sql=" ";
    }
    //update query 
    $update_query = "UPDATE `users_table` SET username='$username',user_email='$user_email', $img_sql user_address='$user_address',user_mobile='$user_mobile' WHERE user_id='$update_id'";
    $update_result = mysqli_query($con, $update_query);
    if ($update_result) {
        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
    }
    $select_query="SELECT * FROM `users_table` WHERE user_id='$update_id'";
    $select_result=mysqli_query($con,$select_query);
    $row=mysqli_fetch_assoc($select_result);
    $user_img=$row['user_image'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Account</title>
    <!----------------Font Awesome cdn links----------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!----------------bootstrap css file link links----------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!----------------Custom css file link links----------------------->
    <link rel="stylesheet" href="../CSS/style.css">
    <style>

    </style>

</head>

<body>
    <h3 class="text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username; ?>" name="user_username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email; ?>" name="user_email">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control" name="user_img">
            <?php if (!empty($user_img)) : ?>
                <img src="./users-images/<?php echo $user_img; ?>" class="edit_img" alt="">
            <?php else : ?>
                <p>Image not found</p>
            <?php endif; ?>
        </div>

        <!-- <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control" name="user_img">
            <img src="./users-images/
            <?php //echo $user_img; ?>
            " class="edit_img" alt="">
        </div> -->
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address; ?>" name="user_address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile; ?>" name="user_mobile">
        </div>

        <input type="submit" value="Update" class="bg-info py-2 px-3 border-0 " name="user_update">
    </form>
</body>

</html>