<?php
include('../Assets/Config/config.php');
include('Assets/login-check.php');

error_reporting(0);
session_start();
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
                <a href="index.php" class="active">
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
                <a href="manage-order.php">
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
                <span class="dashboard">Dashboard</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="overview-boxes">
                <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
            </div>
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <?php
                        //Sql Query 
                        $sq1 = "SELECT * FROM tbl_admin";
                        //Execute Query
                        $res1 = mysqli_query($conn, $sq1);
                        //Count Rows
                        $count1 = mysqli_num_rows($res1);
                        ?>
                        <div class="number"><?php echo $count1; ?></div>
                        <div class="box-topic">Admin</div>
                    </div>
                    <i class='bx bx-user-circle cart'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <?php
                        //Sql Query 
                        $sq2 = "SELECT * FROM tbl_users";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sq2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                        ?>
                        <div class="number"><?php echo $count2; ?></div>
                        <div class="box-topic">Users</div>
                    </div>
                    <i class='bx bxs-user-circle cart two'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <?php
                        //Sql Query 
                        $sq3 = "SELECT * FROM tbl_category";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sq3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                        ?>
                        <div class="number"><?php echo $count3; ?></div>
                        <div class="box-topic">Category</div>
                    </div>
                    <i class='bx bx-list-ul cart three'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <?php
                        //Sql Query 
                        $sql4 = "SELECT * FROM tbl_food";
                        //Execute Query
                        $res4 = mysqli_query($conn, $sql4);
                        //Count Rows
                        $count4 = mysqli_num_rows($res4);
                        ?>
                        <div class="number"><?php echo $count4; ?></div>
                        <div class="box-topic">Foods</div>
                    </div>
                    <i class='bx bx-pie-chart-alt-2 cart four'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <?php
                        //Sql Query 
                        $sql5 = "SELECT * FROM tbl_contact";
                        //Execute Query
                        $res5 = mysqli_query($conn, $sql5);
                        //Count Rows
                        $count5 = mysqli_num_rows($res5);
                        ?>
                        <div class="number"><?php echo $count5; ?></div>
                        <div class="box-topic">Total Contact</div>
                    </div>
                    <i class='bx bx-comment-dots cart four'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <?php
                        //Sql Query 
                        $sql6 = "SELECT * FROM tbl_review";
                        //Execute Query
                        $res6 = mysqli_query($conn, $sql6);
                        //Count Rows
                        $count6 = mysqli_num_rows($res6);
                        ?>
                        <div class="number"><?php echo $count6 ?></div>
                        <div class="box-topic">Total Review</div>
                    </div>
                    <i class='bx bxs-cart-download cart three'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <?php
                        //Sql Query 
                        $sql7 = "SELECT * FROM tbl_cart WHERE status!='Cart' and status!='Payment'";
                        //Execute Query
                        $res7 = mysqli_query($conn, $sql7);
                        //Count Rows
                        $count7 = mysqli_num_rows($res7);
                        ?>
                        <div class="number"><?php echo $count7; ?></div>
                        <div class="box-topic">Total Order</div>
                    </div>
                    <i class='bx bxs-cart-add cart two'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <?php
                        //Sql Query 
                        $sql8 = "SELECT * FROM tbl_cart c, tbl_detailorder d, tbl_food f where c.status='Finished' and d.order_id=c.order_id and f.food_id=d.food_id order by c.status ASC";
                        //Execute Query
                        $res8 = mysqli_query($conn, $sql8);
                        //Count Rows
                        $count8 = mysqli_num_rows($res8);
                        $subtotal = 0;
                        while ($row8 = mysqli_fetch_array($res8)) {
                            $hrg = $row8['price'] . '000';
                            $qtyy = $row8['qty'];
                            $totalharga = $hrg * $qtyy;
                            $subtotal += $totalharga;
                        }
                        ?>
                        <div class="number"><?php echo number_format($subtotal) ?></div>
                        <div class="box-topic">Total Profit</div>
                    </div>
                    <i class='bx bx-dollar cart'></i>
                </div>
            </div>
        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-left");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-left", "bx-menu");
        }
    </script>
</body>

</html>