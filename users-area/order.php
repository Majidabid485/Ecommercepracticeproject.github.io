<?php
include('../Include/connect.php');
include('../functions/comon_function.php');
if (isset($_GET['user_id'])) {
    $user_id=$_GET['user_id'];
}

//getting total items and total price of all items
$get_ip_address=getIPAddress();
$total_price=0;
$cart_query_price="SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart_price=mysqli_query($con,$cart_query_price);
$invoice_number= mt_rand();
$status="pending";
$count_cart_price=mysqli_num_rows($result_cart_price);
while ($row_price=mysqli_fetch_array($result_cart_price)) {
    $product_id=$row_price['product_id'];
    $select_product="SELECT * FROM `products` WHERE product_id=$product_id";
    $result_product=mysqli_query($con,$select_product);
    while ($row_product_price=mysqli_fetch_array($result_product)) {
        $product_price=array($row_product_price['product_price']);
        $product_vales=array_sum($product_price);
        $total_price+=$product_vales;
    }
}

//getting quantity from cart 
$get_cart="SELECT * FROM `cart_details`";
$result_cart=mysqli_query($con,$get_cart);
$get_item_quantity=mysqli_fetch_array($result_cart);
$quantity=$get_item_quantity['quantity'];
if ($quantity==0) {
    $quantity=1;
    $subtotal=$total_price;
}else{
    $quantity=$quantity;
    $subtotal=$total_price*$quantity;
}

$insert_orders="INSERT INTO `users_order` (user_id,amount_due,invoice_number,total_products,order_date,order_status)
VALUES ($user_id,$subtotal,$invoice_number,$count_cart_price,NOW(),'$status')";
$result_insert_orders=mysqli_query($con,$insert_orders);
if ($result_insert_orders) {
    echo "<script>alert('Order are submitted successfully')</script>";
    echo "<script>window.open('./profile.php','_self')</script>";
}

//orders pending
$insert_pending_orders="INSERT INTO `order_pending` (user_id,invoice_number,product_id,quantity,order_status)
VALUES ($user_id,$invoice_number,$product_id,$quantity,'$status')";
$result_pending_orders=mysqli_query($con,$insert_pending_orders);

//delete items from cart 
$empty_cart="DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_empty_cart=mysqli_query($con,$empty_cart);


?>  