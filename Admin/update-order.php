<?php
include('../Assets/Config/config.php');
include('Assets/login-check.php');

$orderid = $_GET['id'];
$liatcust = mysqli_query($conn, "SELECT * from tbl_users u, tbl_cart c where order_id='$orderid' and u.id=c.user_id");
$checkdb = mysqli_fetch_array($liatcust);

$liatreview = mysqli_query($conn, "SELECT * from tbl_review r, tbl_users u where order_id='$orderid' and u.id=r.user_id");
$checkreview = mysqli_fetch_array($liatreview);

if (isset($_POST['confirmed'])) {
    $updatestatus_d = mysqli_query($conn, "UPDATE tbl_cart set status='Delivery' where order_id='$orderid'");

    if ($updatestatus_d) {
        echo "<meta http-equiv='refresh' content='1; url= manage-order.php'/>";
    } else {
        echo "<meta http-equiv='refresh' content='1; url= manage-order.php'/> ";
    }
};

if (isset($_POST['delivery'])) {
    $updatestatus_r = mysqli_query($conn, "UPDATE tbl_cart set status='Review' where order_id='$orderid'");

    if ($updatestatus_r) {
        echo "<meta http-equiv='refresh' content='1; url= manage-order.php'/>";
    } else {
        echo "<meta http-equiv='refresh' content='1; url= manage-order.php'/> ";
    }
};


if (isset($_POST['updateyes'])) {
    $updateactive_y = mysqli_query($conn, "UPDATE tbl_review set active='No' where order_id='$orderid'");

    if ($updateactive_y) {
        echo "<meta http-equiv='refresh' content='1; url= manage-review.php'/>";
    } else {
        echo "<meta http-equiv='refresh' content='1; url= manage-review.php'/> ";
    }
};

if (isset($_POST['updateno'])) {
    $updateactive_n = mysqli_query($conn, "UPDATE tbl_review set active='Yes' where order_id='$orderid'");

    if ($updateactive_n) {
        echo "<meta http-equiv='refresh' content='1; url= manage-review.php'/>";
    } else {
        echo "<meta http-equiv='refresh' content='1; url= manage-review.php'/> ";
    }
};
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
                <?php
                $getui = mysqli_query($conn, "SELECT * from tbl_confirmorder where order_id='$orderid'");
                while ($getuserid = mysqli_fetch_array($getui)) {
                    $userid = $getuserid['user_id'];
                }
                $user = mysqli_query($conn, "SELECT * from tbl_users where id='$userid'");
                while ($u = mysqli_fetch_array($user)) {
                ?>
                    <span class="dashboard">Update Order "<?php echo $orderid; ?>" And Customer Name "<?php echo $u['username'] ?>"</span>
                <?php
                }
                ?>
            </div>
        </nav>
        <br>
        <div class="home-content">
            <div class="overview-boxes">
                <table class="tbl-full">
                    <tr>
                        <th>No</th>
                        <th>Picture</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>

                    <?php
                    $brg = mysqli_query($conn, "SELECT * from tbl_detailorder d, tbl_food f where order_id='$orderid' and d.food_id=f.food_id");
                    $no = 1;
                    while ($b = mysqli_fetch_array($brg)) {
                    ?>
                        <tr>
                            <td><?php echo $no++ ?>.</td>
                            <td>
                                <img src="../Assets/Images/all-menu/<?php echo $b['category'] ?>/<?php echo $b['image_name'] ?>" width="100px" />
                            </td>
                            <td><?php echo $b['name'] ?></td>
                            <td><?php echo $b['qty'] ?></td>
                            <td>IDR <?php echo number_format($b['price']) ?>K</td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>
            </div>
            <div class="overview-boxes">
                <table class="tbl-full">
                    <tr>
                        <th class='ctg-manage-food'>No</th>
                        <th class='ctg-manage-food'>Bukti Pembayaran</th>
                        <th class='ctg-manage-food'>Payment</th>
                        <th class='ctg-manage-food'>Rekening Name</th>
                        <th class='ctg-manage-food'>Alamat</th>
                        <th class='ctg-manage-food'>Tgl Pay</th>
                        <th class='ctg-manage-food'>Tgl Submit</th>

                    </tr>
                    <tr>
                        <?php
                        $brg = mysqli_query($conn, "SELECT * from tbl_confirmorder where order_id='$orderid'");
                        $no = 1;
                        while ($b = mysqli_fetch_array($brg)) {
                            $userid = $b['user_id']
                        ?>
                            <td><?php echo $no++ ?>.</td>
                            <td>
                                <img src="../Assets/Images/users/payment/<?php echo $b['image_name'] ?>" width="100px" />
                            </td>
                            <td class='ctg-manage-food'><?php echo $b['payment'] ?></td>
                            <td class='ctg-manage-food'><?php echo $b['rekening_name'] ?></td>
                            <td class='desc-manage-food'><?php echo $b['alamat'] ?></td>
                            <td class='ctg-manage-food'><?php echo $b['tgl_pay'] ?></td>
                            <td class='ctg-manage-food'><?php echo $b['tgl_submit'] ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                </table>
            </div>
            <div class="overview-boxes">
                <table class="tbl-30">
                    <tr>
                        <th>Total Harga</th>
                    </tr>
                    <?php
                    $brg = mysqli_query($conn, "SELECT * from tbl_detailorder d, tbl_food f where order_id='$orderid' and d.food_id=f.food_id order by d.food_id ASC");
                    $no = 1;
                    $subtotal = 10000;
                    while ($b = mysqli_fetch_array($brg)) {
                        $hrg = $b['price'] . '000';
                        $qtyy = $b['qty'];
                        $totalharga = $hrg * $qtyy;
                        $subtotal += $totalharga
                    ?>
                        <tr>
                            <td class='ctg-manage-food'><?php echo $b['name'] ?><i> x <?php echo number_format($qtyy) ?> </i> <span>Rp <?php echo number_format($totalharga) ?> </span></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td class="total-harga ctg-manage-food">Total (include. 10k Ongkir)<i></i> <span>Rp <?php echo number_format($subtotal) ?></span></td>
                    </tr>
                </table>
                <table class="tbl-30" style='width: 45%;'>
                    <tr>
                        <th class="ctg-manage-food">Rating</th>
                        <th class="ctg-manage-food">Massage Review</th>
                    </tr>
                    <?php
                    $review = mysqli_query($conn, "SELECT * from tbl_review where order_id='$orderid'");
                    while ($r = mysqli_fetch_array($review)) {
                        $rating = $r['rating'];
                        $message = $r['message'];
                    ?>
                        <tr>
                            <td class="ctg-manage-food"><?php echo $rating; ?></td>
                            <td class="desc-manage-food"><?php echo $message; ?></td>

                        </tr>
                    <?php
                    }
                    ?>

                </table>
            </div>
            <div class="overview-boxes">
                <table class="tbl-full">
                    <?php
                    if ($checkdb['status'] == 'Confirmed') {
                        echo '
                            <form method="POST">
                                <input type="submit" name="confirmed" class="btn-update-order" value="[ORDER] Set To Delivery"/>
                            </form>
                        ';
                    } else if ($checkdb['status'] == 'Delivery') {
                        echo '
                            <form method="POST">
                                <input type="submit" name="delivery" class="btn-update-order" value="[ORDER] Set To Review"/>
                            </form>
                        ';
                    }
                    ?>
                    <?php
                    if ($checkreview['active'] == 'Yes') {
                        echo '
                            <form method="POST">
                                <input type="submit" name="updateyes" class="btn-update-order" value="[REVIEW] Set To Display : None"/>
                            </form>
                        ';
                    } else if ($checkreview['active'] == 'No') {
                        echo '
                            <form method="POST">
                                <input type="submit" name="updateno" class="btn-update-order" value="[REVIEW] Set To Display : Yes"/>
                            </form>
                        ';
                    }
                    ?>
                </table>
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