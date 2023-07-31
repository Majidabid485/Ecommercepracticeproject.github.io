<?php
$username=$_SESSION['username'];
$get_user="SELECT * FROM `users_table` WHERE username='$username'";
$run_user=mysqli_query($con,$get_user);
$row_user=mysqli_fetch_array($run_user);
$user_id=$row_user['user_id'];

?>


<h3 class='text-success'>All my Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr>
            <th>Sr no</th>
            <th>Amount Due</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $get_order_details="SELECT * FROM `users_order` WHERE user_id='$user_id'";
        $run_order_details=mysqli_query($con,$get_order_details);
        $number=1;
        while ($row_orders=mysqli_fetch_assoc($run_order_details)) {
            $order_id=$row_orders['order_id'];
            $amount_due=$row_orders['amount_due'];
            $total_products=$row_orders['total_products'];
            $invoice_number=$row_orders['invoice_number'];
            // $total_products=$row_data['total_products'];
            $order_date=$row_orders['order_date'];
            $order_status=$row_orders['order_status'];
            if ($order_status=='pending') {
                $order_status='Incomplete';
            }else{
                $order_status='Complete';
            }
            
            echo "
            <tr>
                <td>$number</td>
                <td>$amount_due</th>
                <td>$total_products</td>
                <td>$invoice_number</th>
                <td>$order_date</td>
                <td>$order_status</td>";
                ?>
                <?php
                if ($order_status=='Complete') {
                    echo "<td>Paid</td>";
                }else{
                    echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>
                    </tr>";
                }
            $number++;
        }
        ?>
    </tbody>
</table>