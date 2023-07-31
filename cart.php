<?php
include('./Include/connect.php');
include('./functions/comon_function.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-commerce Website</title>
  <!----------------Font Awesome cdn links----------------------->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!----------------bootstrap css file link links----------------------->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <!----------------Custom css file link links----------------------->
  <link rel="stylesheet" href="./CSS/style.css">
  <style>
    .cart_img {
      width: 200px;
      object-fit: contain;
    }
  </style>
</head>

<body>
  <!------NavBar---------->
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <img src="./IMG/DYOM-Logo.png" alt="Logo" class="Logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display_all.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./users-area/user_registration.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup>
                  <?php
                  cart_item();
                  ?>
                </sup></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Calling cart function -->
    <?php
    cart();
    ?>


    <!--------second child-------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
      <?php
        if (!isset($_SESSION['username'])) {
          echo "
          <li class='nav-item'>
            <a class='nav-link' href='#'>Welcome Guest</a>
          </li>";
        }else{
          echo "
          <li class='nav-item'>
            <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
          </li>";
        }
        if (!isset($_SESSION['username'])) {
          echo "
          <li class='nav-item'>
            <a class='nav-link' href='./users-area/user_login.php'>Login</a>
          </li>";
        }else{
          echo "
          <li class='nav-item'>
            <a class='nav-link' href='./users-area/logout.php'>Logout</a>
          </li>";
        }
        ?>
      </ul>
    </nav>


    <!--------Third child-------------->
    <div class="bg-light">
      <h3 class="text-center p-3">Cart Products</h3>
      <p class="text-center">Communication is at the heart of e-commerce and community</p>
    </div>

    <!-- Fourth child -->
    <div class="container">
      <div class="row">
        <form action="" method="post">
          <table class="table table-bordered text-center">


            <!-- php code to display dynamic data -->
            <?php
            global $con;
            $total_price = 0;
            $get_ip_address = getIPAddress();
            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
            $result_query = mysqli_query($con, $cart_query);
            $result_count = mysqli_num_rows($result_query);
            if ($result_count > 0) {
              echo "<thead>
                <tr>
                  <th>Product Title</th>
                  <th>Product Image</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>Remove</th>
                  <th colspan='2'>Operations</th>
                </tr>
              </thead>
              <tbody>";
              while ($row = mysqli_fetch_array($result_query)) {
                $product_id = $row['product_id'];
                $select_product_query = "SELECT * FROM `products` WHERE product_id='$product_id'";
                $result_product_query = mysqli_query($con, $select_product_query);
                while ($row_product_price = mysqli_fetch_array($result_product_query)) {
                  $product_price = array($row_product_price['product_price']);
                  $price_table = $row_product_price['product_price'];
                  $product_title = $row_product_price['product_title'];
                  $product_image1 = $row_product_price['product_image1'];
                  $product_values = array_sum($product_price);
                  $total_price = $total_price + $product_values;

            ?>
                  <tr>
                    <td> <?php echo $product_title; ?></td>
                    <td><img src="./Admin-Panel/product_images/<?php echo $product_image1; ?>" class="cart_img" alt=""></td>
                    <td><input type="text" name="quantity" class="form-input w-50"></td>
                    <?php
                    $get_ip_address = getIPAddress();
                    if (isset($_POST['update_cart'])) {
                      $quantities = $_POST['quantity'];
                      $update_cart = "UPDATE `cart_details` SET quantity='$quantities' WHERE ip_address='$get_ip_address'";
                      $result_product_quantity = mysqli_query($con, $update_cart);
                      $total_price = $total_price * $quantities;
                    }
                    ?>
                    <td><?php echo $price_table; ?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php
                                                                          echo $product_id;
                                                                          ?>"></td>
                    <td>
                      <!-- <button class="bg-info px-3 py-2 mx-3 border-0">Update</button> -->
                      <input type="submit" value="Update Cart" class="bg-info px-3 py-2 mx-3 border-0" name="update_cart">
                      <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 mx-3 border-0" name="remove_cart">
                      <!-- <button class="bg-info px-3 py-2 mx-3 border-0">Remove</button> -->
                    </td>
                  </tr>
            <?php }
              }
            } else {
              echo "<h2 class='text-center text-danger p-5'>Cart is Empty</h2>";
            } ?>
            </tbody>
          </table>

          <!-- Subtotal -->
          <div class="d-flex mb-5">
            <?php
            global $con;
            $get_ip_address = getIPAddress();
            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
            $result_query = mysqli_query($con, $cart_query);
            $result_count = mysqli_num_rows($result_query);
            if ($result_count > 0) {
              echo "<h4 class='px-3'>Subtotal : <strong class='text-info'> $total_price/- </strong></h4>
              <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 mx-3 border-0' name='continue_shopping'>
              <button class='bg-secondary p-3 py-2 border-0'><a href='./users-area/checkout.php' class='text-light text-decoration-none'>Check Out</a></button>";
            } else {
              echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 mx-3 border-0' name='continue_shopping'>";
            }
            if (isset($_POST['continue_shopping'])) {
              echo "<script>window.open('index.php','_self')</script>";
            }
            ?>

          </div>
      </div>
    </div>
    </form>
    <!-- Function to remove items -->
    <?php
    function remove_cart_item()
    {
      global $con;
      if (isset($_POST['remove_cart'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
          echo $remove_id;
          $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
          $run_delete = mysqli_query($con, $delete_query);
          if ($run_delete) {
            echo "<script>window.open('cart.php','_self')</script>";
          }
        }
      }
    }
    echo $remove_items = remove_cart_item();
    ?>


    <!--------last child-------------->
    <!-- include footer -->
  </div>
    <?php
    include("./Include/footer.php");
    ?>

  <!----------------bootstrap js links----------------------->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>