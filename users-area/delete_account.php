<h3 class="text-danger my-4">Delete Account</h3>
<form action="" method="post" class="mt-5">
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
    </div>
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="do_not_delete" value="Don't Delete Account">
    </div>
</form>

<?php

$username_session = $_SESSION['username'];
if (isset($_POST['delete'])) {
    $delete_query = "DELETE FROM `users_table` WHERE username='$username_session'";
    $delete_result = mysqli_query($con, $delete_query);
    if ($delete_result) {
        session_destroy();
        echo "<script>alert('Account Deleted Successfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
if (isset($_POST['do_not_delete'])) {
    echo "<script>window.open('profile.php','_self')</script>";
}


?>