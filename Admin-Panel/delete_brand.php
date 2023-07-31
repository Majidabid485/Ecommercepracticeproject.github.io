<?php




if (isset($_GET['delete_brand'])) {
    $delete_brand=$_GET['delete_brand'];
    // echo $delete_category;
    $delete_query="DELETE FROM `brands` WHERE brand_id='$delete_brand'";
    $delete_result=mysqli_query($con,$delete_query);
    if ($delete_result) {
        echo "<script>alert('Brand is been deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }
}

?> 