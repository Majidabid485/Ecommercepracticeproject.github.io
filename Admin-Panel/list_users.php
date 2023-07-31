
<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        $get_user = "SELECT * FROM `users_table`";
        $run_user = mysqli_query($con, $get_user);
        $row_user = mysqli_num_rows($run_user);

        if ($row_user == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No Users yet</h2>";
        } else {
            echo "
            <tr class='text-center'>
                <th>Sr no</th>
                <th>Username</th>
                <th>User Email</th>
                <th>User Image</th>
                <th>User Address</th>
                <th>User Mobile</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";
            $number = 0;
            while ($row_user_data = mysqli_fetch_assoc($run_user)) {
                $user_id = $row_user_data['user_id'];
                $username = $row_user_data['username'];
                $user_email = $row_user_data['user_email'];
                $user_image = $row_user_data['user_image'];
                $user_address = $row_user_data['user_address'];
                $user_mobile = $row_user_data['user_mobile'];
                $number++;
                echo "<tr class='text-center'>
            <td>$number</td>
            <td>$username</td>
            <td>$user_email</td>
            <td><img src='../users-area/users-images/$user_image' class='user_img' alt='$username'></td>
            <td>$user_address</td>
            <td>$user_mobile</td>
            <td><a href='index.php?delete_user=$user_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
            }
        }
        ?>

        </tbody>
</table>