
<h3 class="text-center text-success">All Products </h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $get_products = "SELECT * FROM `products`";
        $run_products = mysqli_query($con, $get_products);
        $number = 0;
        while ($row_products = mysqli_fetch_array($run_products)) {
            $product_id = $row_products['product_id'];
            $product_title = $row_products['product_title'];
            $product_image1 = $row_products['product_image1'];
            $product_price = $row_products['product_price'];
            $product_status = $row_products['product_status'];
            $number++;
        ?>
            <tr class='text-center'>
                <td><?php echo $number; ?> </td>
                <td><?php echo $product_title; ?></td>
                <td><img src='./product_images/<?php echo  $product_image1; ?>' class='product_img'></td>
                <td><?php echo  $product_price; ?>/-</td>
                <td>
                    <?php
                        $get_count="SELECT * FROM `order_pending` WHERE product_id='$product_id'";
                        $run_count=mysqli_query($con,$get_count);
                        $count_row=mysqli_num_rows($run_count);
                        echo $count_row;
                    ?>
                </td>
                <td><?php echo  $product_status; ?></td>
                <td><a href='index.php?edit_products=<?php echo $product_id; ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></i></a></td>
                <td><a href='index.php?delete_product=<?php echo $product_id; ?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr> 
        <?php
        }
        ?>

    </tbody>
</table>