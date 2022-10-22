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
                <a href="manage-category.php" class="active">
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
                <span class="dashboard">Update Category</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="overview-boxes">
                <?php
                //Check whether the id is set or not
                if (isset($_GET['id'])) {
                    //Get the ID and all other details
                    //echo "Getting the Data";
                    $id = $_GET['id'];
                    //Create SQL Query to get all other details
                    $sql = "SELECT * FROM tbl_category WHERE id=$id";
                    //Execute the Query
                    $res = mysqli_query($conn, $sql);
                    //Count the Rows to check whether the id is valid or not
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        //Get all the data
                        $row = mysqli_fetch_assoc($res);
                        $name = $row['name'];
                        $category = $row['category'];
                        $active = $row['active'];
                    } else {
                        //redirect to manage category with session message
                        $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                        header('location:' . SITEURL . 'Admin/manage-category.php');
                    }
                } else {
                    //redirect to Manage CAtegory
                    header('location:' . SITEURL . 'aAmin/manage-category.php');
                }
                ?>
                <?php
                if (isset($_SESSION['no-category-found'])) {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                ?>
            </div>
            <div class="overview-boxes">
                <table class="tbl-full">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <tr>
                            <td>Title: </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $name; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Category: </td>
                            <td>
                                <input type="text" name="category" value="<?php echo $category; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Active: </td>
                            <td>
                                <input <?php if ($active == "Yes") {
                                            echo "checked";
                                        } ?> class='active' type="radio" name="active" value="Yes"> Yes
                                <input <?php if ($active == "No") {
                                            echo "checked";
                                        } ?> class='active' type="radio" name="active" value="No"> No
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                            </td>
                        </tr>
                    </form>
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

<?php
if (isset($_POST['submit'])) {
    //echo "Clicked";
    //1. Get all the values from our form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $active = $_POST['active'];
    //3. Update the Database
    $sql2 = "UPDATE tbl_category SET 
            name = '$name',
            category = '$category',
            active = '$active' 
            WHERE id=$id
            
        ";
    //Execute the Query
    $res2 = mysqli_query($conn, $sql2);
    //4. REdirect to Manage Category with MEssage
    //CHeck whether executed or not
    if ($res2 == true) {
        //Category Updated
        $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
        header('location:' . SITEURL . 'Admin/manage-category.php');
    } else {
        //failed to update category
        $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
        header('location:' . SITEURL . 'Admin/manage-category.php');
    }
}
?>