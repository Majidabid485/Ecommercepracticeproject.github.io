<?php






if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $get_data = "SELECT * FROM `products` WHERE product_id='$edit_id'";
    $run_data = mysqli_query($con, $get_data);
    $row_data = mysqli_fetch_assoc($run_data);
    // print_r($row_data);
    $product_title = $row_data['product_title'];
    $product_description = $row_data['product_description'];
    $product_keywords = $row_data['product_keywords'];
    $category_id = $row_data['category_id'];
    $brand_id = $row_data['brand_id'];
    $product_image1 = $row_data['product_image1'];
    $product_image2 = $row_data['product_image2'];
    $product_image3 = $row_data['product_image3'];
    $product_price = $row_data['product_price'];



    //fetching category name
    $get_category = "SELECT * FROM `categories` WHERE category_id='$category_id'";
    $run_category = mysqli_query($con, $get_category);
    $row_category = mysqli_fetch_assoc($run_category);
    $category_title = $row_category['category_title'];
    // echo $category_title;


    //fetching brand name
    $get_brands = "SELECT * FROM `brands` WHERE brand_id='$brand_id'";
    $run_brands = mysqli_query($con, $get_brands);
    $row_brands = mysqli_fetch_assoc($run_brands);
    $brand_title = $row_brands['brand_title'];
    // echo $brand_title;
}

?>


<div class="container mt-5">
    <h1 class="text-center">Edit Products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- title -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" name="product_title" value="<?php echo $product_title; ?>" id="product_title" class="form-control" required>
        </div>
        <!-- description -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="description" class="form-label">Product Description</label>
            <input type="text" name="description" value="<?php echo $product_description; ?>" id="description" class="form-control" required>
        </div>
        <!-- Keywords -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" name="product_keywords" value="<?php echo $product_keywords; ?>" id="product_keywords" class="form-control" required>
        </div>
        <!-- categories -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_categories" class="form-label">Product Categories</label>
            <select name="product_category" id="" class="form-select">
                <option value="<?php echo $category_title; ?>"><?php echo $category_title; ?></option>
                <?php
                $get_category_all = "SELECT * FROM `categories`";
                $run_category_all = mysqli_query($con, $get_category_all);
                while ($row_category_all = mysqli_fetch_assoc($run_category_all)) {
                    $category_id = $row_category_all['category_id'];
                    $category_title = $row_category_all['category_title'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>
        <!-- brands -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_brand" class="form-label">Product Brand</label>
            <select name="product_brands" id="" class="form-select">
                <option value="<?php echo $brand_title; ?>"><?php echo $brand_title; ?></option>
                <?php
                $get_brands_all = "SELECT * FROM `brands`";
                $run_brands_all = mysqli_query($con, $get_brands_all);
                while ($row_brands_all = mysqli_fetch_assoc($run_brands_all)) {
                    $brand_id = $row_brands_all['brand_id'];
                    $brand_title = $row_brands_all['brand_title'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
            </select>
        </div>
        <!-- Product Image 1 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image1" class="form-label">Product Image 1</label>
            <div class="d-flex">
                <input type="file" name="product_image1" id="product_image1" class="form-control w-90 m-auto" required>
                <img src="./product_images/<?php echo $product_image1; ?>" class="product_img" alt="">
            </div>
        </div>
        <!-- Product Image 2 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image2" class="form-label">Product Image 2</label>
            <div class="d-flex">
                <input type="file" name="product_image2" id="product_image2" class="form-control w-90 m-auto" required>
                <img src="./product_images/<?php echo $product_image2; ?>" class="product_img" alt="">
            </div>
        </div>
        <!-- Product Image 3 -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image3" class="form-label">Product Image 3</label>
            <div class="d-flex">
                <input type="file" name="product_image3" id="product_image3" class="form-control w-90 m-auto" required>
                <img src="./product_images/<?php echo $product_image3; ?>" class="product_img" alt="">
            </div>
        </div>
        <!-- Price -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" name="product_price" value="<?php echo $product_price; ?>" id="product_price" class="form-control" required>
        </div>
        <!-- Insert Product button -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="edit_product" class="btn btn-info mb-3 px-3" value="Update Product">
        </div>
    </form>
</div>

<!-- Editing products -->
<?php
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    $product_image1_tmp = $_FILES['product_image1']['tmp_name'];
    $product_image2_tmp = $_FILES['product_image2']['tmp_name'];
    $product_image3_tmp = $_FILES['product_image3']['tmp_name'];

    //checking for fields empty or not
    if (
        $product_title == '' or $description == '' or $product_keywords == '' or $product_category == '' or $product_brands == ''
        or $product_image1 == '' or $product_image2 == '' or $product_image3 == '' or $product_price == ''
    ) {
        echo "<script>alert('Please fill all the fields and continue the process')</script>";
    } else {
        move_uploaded_file($product_image1_tmp, "./product_images/$product_image1");
        move_uploaded_file($product_image2_tmp, "./product_images/$product_image2");
        move_uploaded_file($product_image3_tmp, "./product_images/$product_image3");
        //query to update products
        $query = "UPDATE `products` SET product_title = '$product_title', product_description = '$description',
         product_keywords = '$product_keywords', category_id = '$product_category', 
         brand_id = '$product_brands', product_image1='$product_image1',product_image2='$product_image2',
         product_image3='$product_image3', product_price ='$product_price',product_date=NOW() 
         WHERE product_id='$edit_id'";
         $result = mysqli_query($con, $query);
         if ($result) {
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
         }
    }
}


?>