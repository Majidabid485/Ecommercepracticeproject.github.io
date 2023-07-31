<?php



if (isset($_GET['edit_brand'])) {
    $edit_brand=$_GET['edit_brand'];

    $get_brands="SELECT * FROM `brands` WHERE brand_id='$edit_brand'";
    $run_brands=mysqli_query($con,$get_brands);
    $row_brands=mysqli_fetch_assoc($run_brands);
    $brand_title=$row_brands['brand_title'];
}
if (isset($_POST['edit_brands'])) {
    $brand_title=$_POST['brand_title'];
    $update_query="UPDATE `brands` SET brand_title='$brand_title' WHERE brand_id='$edit_brand'";
    $update_result=mysqli_query($con,$update_query);
    if ($update_result) {
        echo "<script>alert('Brand is been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }
}

?>


<div class="container mt-3">
    <h1 class="text-center">Edit Brands</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">Brand Title</label>
            <input type="text" value="<?php echo $brand_title; ?>" name="brand_title" id="brand_title" class="form-control" required>
        </div>
        <input type="submit" name="edit_brands" class="btn btn-info mb-3 px-3" value="Update Brand">
    </form>
</div>