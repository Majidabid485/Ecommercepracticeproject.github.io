

<h3 class="text-center text-success">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        $get_user_order = "SELECT * FROM `users_order`";
        $run_user_order = mysqli_query($con, $get_user_order);
        $row_user_order = mysqli_num_rows($run_user_order);

        if ($row_user_order == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No orders yet</h2>";
        } else {
            echo "
            <tr class='text-center'>
                <th>Sr no</th>
                <th>Due Amount</th>
                <th>Invoice Number</th>
                <th>Total Products</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";
            $number = 0;
            while ($row_user_order_data = mysqli_fetch_assoc($run_user_order)) {
                $order_id = $row_user_order_data['order_id'];
                $user_id = $row_user_order_data['user_id'];
                $amount_due = $row_user_order_data['amount_due'];
                $invoice_number = $row_user_order_data['invoice_number'];
                $total_products = $row_user_order_data['total_products'];
                $order_date = $row_user_order_data['order_date'];
                $order_status = $row_user_order_data['order_status'];
                $number++;
                echo "<tr class='text-center'>
            <td>$number</td>
            <td>$amount_due</td>
            <td>$invoice_number</td>
            <td>$total_products</td>
            <td>$order_date</td>
            <td>$order_status</td>
            <td><a href='index.php?delete_order=$order_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
            }
        }
        ?>

        </tbody>
</table>