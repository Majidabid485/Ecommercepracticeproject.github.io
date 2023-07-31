<?php


if (isset($_GET['delete_order'])) {
    $delete_order=$_GET['delete_order'];
    // echo $delete_category;
    $delete_query="DELETE FROM `users_order` WHERE order_id='$delete_order'";
    $delete_result=mysqli_query($con,$delete_query);
    if ($delete_result) {
        echo "<script>alert('Order is been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_orders','_self')</script>";
    }
}

?> 