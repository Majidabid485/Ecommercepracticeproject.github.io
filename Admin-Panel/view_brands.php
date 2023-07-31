
<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class='text-center'>
            <th>Sr no</th>
            <th>Brand Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
         <?php
        $get_brand = "SELECT * FROM `brands`";
        $run_brands = mysqli_query($con, $get_brand);
        $number = 0;
        while ($row_brands = mysqli_fetch_array($run_brands)) {
            $brand_id = $row_brands['brand_id'];
            $brand_title = $row_brands['brand_title'];
            $number++;
        ?> 
            <tr class='text-center'>
                <td><?php echo  $number; ?></td>
                <td><?php echo  $brand_title; ?></td>
                <td><a href='index.php?edit_brand=<?php echo $brand_id; ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></i></a></td>
                <td><a href='index.php?delete_brand=<?php echo $brand_id; ?>' class="text-light"><i class='fa-solid fa-trash'></i></a></td>
            </tr>  
        <?php
        }
        ?>

    </tbody>
</table>