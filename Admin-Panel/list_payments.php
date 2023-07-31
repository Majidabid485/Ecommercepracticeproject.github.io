
<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        $get_user_payment = "SELECT * FROM `user_payments`";
        $run_user_payment = mysqli_query($con, $get_user_payment);
        $row_user_payment = mysqli_num_rows($run_user_payment);

        if ($row_user_payment == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No payments receive yet</h2>";
        } else {
            echo "
            <tr class='text-center'>
                <th>Sr no</th>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Payment Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";
            $number = 0;
            while ($row_user_payment_data = mysqli_fetch_assoc($run_user_payment)) {
                $payment_id = $row_user_payment_data['payment_id'];
                $order_id = $row_user_payment_data['order_id'];
                $invoice_number = $row_user_payment_data['invoice_number'];
                $amount= $row_user_payment_data['amount'];
                $payment_mode = $row_user_payment_data['payment_mode'];
                $payment_date = $row_user_payment_data['date'];
                $number++;
                echo "<tr class='text-center'>
            <td>$number</td>
            <td>$invoice_number</td>
            <td>$amount</td>
            <td>$payment_mode</td>
            <td>$payment_date</td>
            <td><a href='index.php?delete_payment=$payment_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
            }
        }
        ?>

        </tbody>
</table>