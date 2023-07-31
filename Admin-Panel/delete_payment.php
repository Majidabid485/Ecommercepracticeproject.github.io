<?php



if (isset($_GET['delete_payment'])) {
    $delete_payment=$_GET['delete_payment'];
    // echo $delete_category;
    $delete_query="DELETE FROM `user_payments` WHERE payment_id='$delete_payment'";
    $delete_result=mysqli_query($con,$delete_query);
    if ($delete_result) {
        echo "<script>alert('Payment is been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_payments','_self')</script>";
    }
}

?> 