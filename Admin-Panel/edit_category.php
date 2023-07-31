<?php



if (isset($_GET['edit_category'])) {
    $edit_category=$_GET['edit_category'];

    $get_categories="SELECT * FROM `categories` WHERE category_id='$edit_category'";
    $run_categories=mysqli_query($con,$get_categories);
    $row_categories=mysqli_fetch_assoc($run_categories);
    $category_title=$row_categories['category_title'];
}
if (isset($_POST['edit_cat'])) {
    $cat_title=$_POST['category_title'];
    $update_query="UPDATE `categories` SET category_title='$cat_title' WHERE category_id='$edit_category'";
    $update_result=mysqli_query($con,$update_query);
    if ($update_result) {
        echo "<script>alert('Category is been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_category','_self')</script>";
    }
}

?>


<div class="container mt-3">
    <h1 class="text-center">Edit Category</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Category Title</label>
            <input type="text" value="<?php echo $category_title; ?>" name="category_title" id="category_title" class="form-control" required>
        </div>
        <input type="submit" name="edit_cat" class="btn btn-info mb-3 px-3" value="Update Category">
    </form>
</div>