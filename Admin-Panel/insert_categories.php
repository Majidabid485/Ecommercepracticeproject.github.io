<?php
include('../Include/connect.php');




if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    //select data from database
    $category_title = mysqli_real_escape_string($con, $category_title);
    $select_query = "SELECT * FROM `categories` WHERE category_title = '$category_title'";
    $result_select = mysqli_query($con,$select_query);
    $number = mysqli_num_rows($result_select);
    if ($number>0) {
        echo "<script>alert('This category is present inside the database')</script>";
    }else{
    $insert_query = "INSERT INTO `categories` (category_title) values ('$category_title')";
    $result = mysqli_query($con,$insert_query);
    if ($result) {
        echo "<script>alert('Category has been inserted successfully')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Categories</title>
</head>

<body>
    <h3 class="text-center">Insert Category</h3>
    <form action="" method="post" class="mb-2">
        <div class="input-group w-90 mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text bg-info" id="basic-addon1"><i style="height: 22px;" class="fa-solid fa-receipt"></i></span>
            </div>
            <input type="text" class="form-control" name="cat_title" placeholder="Insert Category" aria-label="Insert Category"
                aria-describedby="basic-addon1">
        </div>
        <div class="input-group w-10 mb-2 m-auto">
            
            <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="Insert Categories">
            <!----- 
            <button class="bg-info p-2 my-3 border-0" >Insert Categories</button>------->
        </div>
    </form>
</body>

</html>