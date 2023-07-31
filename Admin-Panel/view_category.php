
<h3 class="text-center text-success">All Category</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class='text-center'>
            <th>Sr no</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
         <?php
        $get_category = "SELECT * FROM `categories`";
        $run_categories = mysqli_query($con, $get_category);
        $number = 0;
        while ($row_categories = mysqli_fetch_array($run_categories)) {
            $category_id = $row_categories['category_id'];
            $category_title = $row_categories['category_title'];
            $number++;
        ?> 
            <tr class='text-center'>
                <td><?php echo  $number; ?></td>
                <td><?php echo  $category_title; ?></td>
                <td><a href='index.php?edit_category=<?php echo $category_id; ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></i></a></td>
                <td><a href='index.php?delete_category=<?php echo $category_id; ?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr> 
        <?php
        }
        ?>

    </tbody>
</table>