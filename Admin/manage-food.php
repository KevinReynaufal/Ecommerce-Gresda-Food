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
                <a href="manage-food.php" class="active">
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
                <span class="dashboard">Manage Food</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="overview-boxes">
            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            </div>
            <div class="overview-boxes">
            <a href="<?php echo SITEURL; ?>Admin/add-food.php" class="btn-primary">Add Food</a>
            <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        //Create a SQL Query to Get all the Food
                        $sql = "SELECT * FROM tbl_food";
                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);
                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);
                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;
                        if($count>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $id = $row['food_id'];
                                $category = $row['category'];
                                $name = $row['name'];
                                $price = $row['price'];
                                $description = $row['description'];
                                $image_name = $row['image_name'];
                                $active = $row['active'];
                                ?>
                                <tr>
                                    <td class='ctg-manage-food'><?php echo $sn++; ?>. </td>
                                    <td class='ctg-manage-food'><?php echo $category; ?></td>
                                    <td class='ctg-manage-food'><?php echo $name; ?></td>
                                    <td class='desc-manage-food'><?php echo $description; ?></td>
                                    <td class='ctg-manage-food'><?php echo $price; ?></td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($image_name=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //WE Have Image, Display Image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>Assets/Images/all-menu/<?php echo $category; ?>/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td class='ctg-manage-food'><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>Admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                        <br>
                                        <a href="<?php echo SITEURL; ?>Admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>&category=<?php echo $category; ?>" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
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