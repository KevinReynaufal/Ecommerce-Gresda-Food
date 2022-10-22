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
                <span class="dashboard">Add Category</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="overview-boxes">
                <?php
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if (isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                ?>
            </div>
            <div class="overview-boxes">
                <table class="tbl-full">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <tr>
                            <td>Name :</td>
                            <td>
                                <input type="text" name="name" placeholder="Name">
                            </td>
                        </tr>
                        <tr>
                            <td>Category : </td>
                            <td>
                                <input type="text" name="category" placeholder="Category Name">
                            </td>
                        </tr>
                        <tr>
                            <td>Active : </td>
                            <td>
                                <input class='active' type="radio" name="active" value="Yes"> Yes
                                <input class='active' type="radio" name="active" value="No"> No
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
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
//CHeck whether the Submit Button is Clicked or Not
if (isset($_POST['submit'])) {
    //echo "Clicked";
    //1. Get the Value from CAtegory Form
    $name = $_POST['name'];
    $category = $_POST['category'];
    //For Radio input, we need to check whether the button is selected or not
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }
    //Check whether the image is selected or not and set the value for image name accoridingly
    //print_r($_FILES['image']);
    //die();//Break the Code Here
    //2. Create SQL Query to Insert CAtegory into Database
    $sql = "INSERT INTO tbl_category SET 
            name='$name',
            category='$category',
            active='$active'
        ";
    //3. Execute the Query and Save in Database
    $res = mysqli_query($conn, $sql);
    //4. Check whether the query executed or not and data added or not
    if ($res == true) {
        //Query Executed and Category Added
        $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
        //Redirect to Manage Category Page
        header('location:' . SITEURL . 'Admin/manage-category.php');
    } else {
        //Failed to Add CAtegory
        $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
        //Redirect to Manage Category Page
        header('location:' . SITEURL . 'Admin/add-category.php');
    }
}
?>