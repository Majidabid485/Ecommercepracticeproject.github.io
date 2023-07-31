<?php
include('../Include/connect.php');
session_start();
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    // echo $order_id;
    $select_query = "SELECT * FROM `users_order` WHERE order_id='$order_id'";
    $result = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
}
if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount_due = $_POST['amount_due'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "INSERT INTO `user_payments` (order_id,invoice_number,amount,payment_mode) 
    Values ('$order_id','$invoice_number','$amount_due','$payment_mode')";
    $result=mysqli_query($con,$insert_query);
    if ($result) {
        echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_order="UPDATE `users_order` set order_status='Complete' WHERE order_id=$order_id";
    $result_orders=mysqli_query($con,$update_order);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Page</title>
    <!----------------Font Awesome cdn links----------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!----------------bootstrap css file link links----------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!----------------Custom css file link links----------------------->
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Invoice Number</label>
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number; ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount_due" value="<?php echo $amount_due; ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Payment Method</label>
                <select name="payment_mode"  class="form-select w-50 m-auto">
                    <option value="">Select Payment Mode</option>
                    <option value="UPI">UPI</option>
                    <option value="Netbanking">Netbanking</option>
                    <option value="Paypal">Paypal</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="Pay Offline">Pay Offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>

</html>