<?php
include('../Include/connect.php');
include('../functions/comon_function.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-commerce Website - Payment Page</title>
  <!----------------Font Awesome cdn links----------------------->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!----------------bootstrap css file link links----------------------->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <!----------------Custom css file link links----------------------->

  <style>
    img {
      width: 70%;
      margin: auto;
      display: block;  
    }
  </style>


</head>

<body>
  <!-- php code to access user id -->
  <?php
  $user_ip=getIPAddress();
  $get_user="SELECT * FROM `users_table` WHERE user_ip='$user_ip'";
  $result_user=mysqli_query($con,$get_user);
  $row_user=mysqli_fetch_array($result_user);
  $user_id=$row_user['user_id'];
  
  ?>
  <div class="container">
    <h2 class="text-center text-info">Payment Options</h2>
    <div class="row d-flex justify-content-center align-items-center my-5">
      <div class="col-md-6">
        <a href="https://www.paypal.com/us/home" style="cursor:pointer"><img src="../IMG/Paypal.jpg" alt=""></a>
      </div>
      <div class="col-md-6">
        <a href="order.php?user_id=<?php echo $user_id; ?>">
          <h2 class="text-center">Pay offline</h2>
        </a>
      </div>
    </div>
  </div>
</body>

</html>