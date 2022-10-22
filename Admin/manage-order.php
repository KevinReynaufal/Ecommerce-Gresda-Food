<?php 
    include('../Assets/Config/config.php'); 
    include('Assets/login-check.php');
?>
<html>

<head>
    <!-- Title & Image In Tab Website -->
    <title>Gresda Administrator</title>
    <link rel="icon" href="Assets/Images/LogoGresda.jpg">
    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="style.css">
    <!-- Required Meta Tags -->
    <meta char set="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome CDN Link  -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <!-- Navbar Section Starts -->
    <div class="sidebar">
        <div class="logo-details">
            <i class='fab fa-guilded'></i>
            <span class="logo_name">Gresda Food</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="index.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="manage-admin.php">
                    <i class='bx bx-support'></i>
                    <span class="links_name">Manage Admin</span>
                </a>
            </li>
            <li>
                <a href="manage-user.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Manage Users</span>
                </a>
            </li>
            <li>
                <a href="manage-category.php">
                    <i class='bx bx-folder-open'></i>
                    <span class="links_name">Manage Category</span>
                </a>
            </li>
            <li>
                <a href="manage-food.php">
                    <i class='bx bx-drink'></i>
                    <span class="links_name">Manage Food</span>
                </a>
            </li>
            <li>
                <a href="manage-contact.php">
                    <i class='bx bx-envelope'></i>
                    <span class="links_name">Manage Contact</span>
                </a>
            </li>
            <li>
                <a href="manage-review.php">
                    <i class='bx bx-comment-detail'></i>
                    <span class="links_name">Manage Review</span>
                </a>
            </li>
            <li>
                <a href="manage-order.php" class="active">
                    <i class='bx bx-book'></i>
                    <span class="links_name">Manage Order</span>
                </a>
            </li>
            <li class="log_out">
                <a href="Assets/logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Navbar Section End -->

    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Manage Order</span>
            </div>
        </nav>
        <br>
        <div class="home-content">
            <div class="overview-boxes">
            <?php 
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            </div>
            <div class="overview-boxes">
                <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Id Order</th>
                    <th>Customer Name</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    //Get all the orders from database
                    $sql = "SELECT * FROM tbl_cart c, tbl_users u  where u.id=c.user_id and c.cart_id order by c.order_id ASC"; // DIsplay the Latest Order at First
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //Count the Rows
                    $count = mysqli_num_rows($res);
                    $sn = 1; //Create a Serial Number and set its initail value as 1
                    if($count>0)
                    {
                        //Order Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get all the order details
                            $cart_id = $row['cart_id'];
                            $order_id = $row['order_id'];
                            $username = $row['username'];
                            $order_date = $row['tgl_order'];
                            $status = $row['status'];
                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $order_id; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td>
                                        <?php 
                                            // Ordered, On Delivery, Delivered, Cancelled
                                            if($status=="Cart"){
                                                echo "<label style='color: black;'>$status</label>";
                                            }else if($status=="Payment"){
                                                echo "<label style='color: blue;'>$status</label>";
                                            }else if($status=="Confirmed"){
                                                echo "<label style='color: red;'>$status</label>";
                                            }else if($status=="Delivery"){
                                                echo "<label style='color: red;'>$status</label>";
                                            }elseif($status=="Review"){
                                                echo "<label style='color: blue;'>$status</label>";
                                            }elseif($status=="Finished"){
                                                echo "<label style='color: green;'>$status</label>";
                                            }elseif($status=="Canceled"){
                                                echo "<label style='color: black;'>$status</label>";
                                            }else{
                                                echo "<label style='color: red;'>ERROR</label>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $order_id; ?>" class="btn-secondary">Update Order</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        //Order not Available
                        echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                    }
                ?>
                </table>
            </div>
        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-left");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-left", "bx-menu");
        }
    </script>
</body>

</html>