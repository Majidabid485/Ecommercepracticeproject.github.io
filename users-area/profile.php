<?php
include('../Include/connect.php');
include('../functions/comon_function.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome <?php echo $_SESSION['username']; ?></title>
    <!----------------Font Awesome cdn links----------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!----------------bootstrap css file link links----------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!----------------Custom css file link links----------------------->
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        .profile_img {
            width: 100%;
            /* height: 100%; */
            margin: auto;
            display: block;
            object-fit: contain;
        }

        .edit_img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <!------NavBar---------->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../IMG/DYOM-Logo.png" alt="Logo" class="Logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup>
                                    <?php
                                    cart_item();
                                    ?>
                                </sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price:
                                <?php
                                total_cart_price();
                                ?>/- </a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data" />
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_products">
                    </form>
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
                } else {
                    echo "
          <li class='nav-item'>
            <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
          </li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo "
          <li class='nav-item'>
            <a class='nav-link' href='user_login.php'>Login</a>
          </li>";
                } else {
                    echo "
          <li class='nav-item'>
            <a class='nav-link' href='logout.php'>Logout</a>
          </li>";
                }
                ?>
            </ul>
        </nav>


        <!--------Third child-------------->
        <div class="bg-light">
            <h3 class="text-center p-3">User Profile</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>


        <!--------Fourth child-------------->
        <div class="container">
            <div class="row">
                <div class="col-md-2 p-0">
                    <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
                        <li class="nav-item bg-info">
                            <a class="nav-link text-light" href="#">
                                <h4>Your Profile</h4>
                            </a>
                        </li>
                        <?php
                        // session_start(); // Make sure to start the session before using $_SESSION

                        // Check if 'username' is set in the $_SESSION array
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];

                            $user_img = "SELECT * FROM `users_table` WHERE username='$username'";
                            $user_img_result = mysqli_query($con, $user_img);

                            // Check if any rows were returned by the query
                            if (mysqli_num_rows($user_img_result) > 0) {
                                $user_img_row = mysqli_fetch_assoc($user_img_result);
                                $user_img = $user_img_row['user_image'];
                                echo "<li class='nav-item'>
                                        <img src='./users-images/$user_img' class='profile_img my-4'>
                                    </li>";
                            } else {
                                // Handle the case when no rows are returned
                                echo "No user found with the given username.";
                            }
                        } else {
                            // Handle the case when 'username' is not set in the $_SESSION array
                            echo "<p class='text-light'>  Username not set in session.</p>";
                        }
                        ?>


                        <li class="nav-item">
                            <a class="nav-link text-light" href="profile.php">Pending Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10 text-center">
                    <?php
                    get_user_order_details();
                    if (isset($_GET['edit_account'])) {
                        include('edit_account.php');
                    }
                    if (isset($_GET['my_orders'])) {
                        include('users_orders.php');
                    }
                    if (isset($_GET['delete_account'])) {
                        include('delete_account.php');
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--------last child-------------->
        <!-- include footer -->
        <?php
        include("../Include/footer.php");
        ?>
    </div>

    <!----------------bootstrap js links----------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>