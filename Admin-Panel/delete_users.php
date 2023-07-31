<?php

if (isset($_GET['delete_user'])) {
    $delete_id = $_GET['delete_user'];
    // echo $delete_id;
    //delete query
    $delete_query = "DELETE FROM `users_table` WHERE user_id='$delete_id'";
    $delete_result = mysqli_query($con, $delete_query); 
    if ($delete_result) {
        echo "<script>alert('User deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_users','_self')</script>";
    }
}
