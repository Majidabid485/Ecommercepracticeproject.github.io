<?php
include('../Include/connect.php');
include('../functions/comon_function.php');
include('../Include/authentication.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <!----------------bootstrap css file link links----------------------->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />

  <!----------------Font Awesome cdn links----------------------->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!----------------custom css file link links----------------------->
  <link rel="stylesheet" href="../CSS/style.css">
  <style>
    .product_img {
      width: 100px;
      object-fit: contain;
    }

    .user_img {
      width: 100px;
      object-fit: contain;
    }
  </style>
</head>

<body>
  <!--------Navbar------------>
  <div class="container-fluid p-0">
    <!--------First Child------------>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <img src="../IMG/DYOM-Logo.png" class="Logo" alt="">
        <nav class="navbar navbar-expand-lg">
          <ul class="navbar-nav">
            <?php
            // print_r($_SESSION);
            if (!isset($_SESSION['admin_username'])) {
              echo "
          <li class='nav-item'>
            <a class='nav-link' href='#'>Welcome Guest</a>
          </li>";
            } else {
              echo "
          <li class='nav-item'>
            <a class='nav-link' href='#'>Welcome " . $_SESSION['admin_username'] . "</a>
          </li>";
            }
            ?>
          </ul>
          </ul>
        </nav>
      </div>
    </nav>

    <!--------second Child------------>
    <div class="bg-light">
      <h3 class="text-center p-3">Manage Details</h3>
    </div>

    <!--------third Child------------>
    <?php
    $select_query="SELECT * FROM `admin_table` WHERE admin_name='$_SESSION[admin_username]';";
    $select_result=mysqli_query($con,$select_query);
    $row=mysqli_fetch_assoc($select_result);
    $admin_image=$row['admin_image'];
    $admin_name=$row['admin_name'];
    
    ?>
    <div class="bg-secondary">
      <div class="container">
        <div class="row">
          <div class="col-md-12 p-1 d-flex align-items-center">
            <div class="p-3">
              <a href=""><img src="./product_images/<?= $admin_image ?>" class="admin_image" alt=""></a>
              <p class="text-light text-center"><?= $admin_name ?></p>
            </div>
            <div class="button text-center">
              <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1 p-3">Insert Products</a></button>
              <button class="my-3"><a href="index.php?view_products" class="nav-link text-light bg-info my-1 p-3">View Products</a></button>
              <button class="my-3"><a href="index.php?insert_category" class="nav-link text-light bg-info my-1 p-3">Insert Categories</a></button>
              <button class="my-3"><a href="index.php?view_category" class="nav-link text-light bg-info my-1 p-3">View Categories</a></button>
              <button class="my-3"><a href="index.php?insert_brands" class="nav-link text-light bg-info my-1 p-3">Insert Brands</a></button>
              <button class="my-3"><a href="index.php?view_brands" class="nav-link text-light bg-info my-1 p-3">View Brands</a></button>
              <button class="my-3"><a href="index.php?list_orders" class="nav-link text-light bg-info my-1 p-3">All Orders</a></button>
              <button class="my-3"><a href="index.php?list_payments" class="nav-link text-light bg-info my-1 p-3">All Payments</a></button>
              <button class="my-3"><a href="index.php?list_users" class="nav-link text-light bg-info my-1 p-3">List Users</a></button>
              <button class="my-3"><a href="index.php?logout" class="nav-link text-light bg-info my-1 p-3">Logout</a></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--------fourth Child------------>
    <div class="container my-3">
      <?php
      if (isset($_GET['insert_category'])) {
        include('insert_categories.php');
      }
      if (isset($_GET['insert_brands'])) {
        include('insert_brands.php');
      }
      if (isset($_GET['view_products'])) {
        include('view_products.php');
      }
      if (isset($_GET['edit_products'])) {
        include('edit_products.php');
      }
      if (isset($_GET['delete_product'])) {
        include('delete_product.php');
      }
      if (isset($_GET['view_category'])) {
        include('view_category.php');
      }
      if (isset($_GET['view_brands'])) {
        include('view_brands.php');
      }
      if (isset($_GET['edit_category'])) {
        include('edit_category.php');
      }
      if (isset($_GET['edit_brand'])) {
        include('edit_brand.php');
      }
      if (isset($_GET['delete_category'])) {
        include('delete_category.php');
      }
      if (isset($_GET['delete_brand'])) {
        include('delete_brand.php');
      }
      if (isset($_GET['list_orders'])) {
        include('list_orders.php');
      }
      if (isset($_GET['delete_order'])) {
        include('delete_order.php');
      }
      if (isset($_GET['list_payments'])) {
        include('list_payments.php');
      }
      if (isset($_GET['delete_payment'])) {
        include('delete_payment.php');
      }
      if (isset($_GET['list_users'])) {
        include('list_users.php');
      }
      if (isset($_GET['delete_user'])) {
        include('delete_users.php');
      }
      if (isset($_GET['logout'])) {
        include('logout.php');
      }
      ?>
    </div>



    <!--------last child-------------->
    <!-- <div class="bg-info p-3 text-center footer">
          <p>All rights reserved ©- Designed by Mutawir-2023</p>
        </div> -->
    <?php
    include("../Include/footer.php");
    ?>
  </div>











  <!----------------bootstrap js links----------------------->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>