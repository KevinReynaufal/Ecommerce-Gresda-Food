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
                <span class="dashboard">Add Food</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="overview-boxes">
            <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
            </div>
            <div class="overview-boxes">
                <table class="tbl-full">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <tr>
                            <td>Category : </td>
                            <td>
                                <select name="category">

                                    <?php 
                                        //Create PHP Code to display categories from Database
                                        //1. CReate SQL to get all active categories from database
                                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                        
                                        //Executing qUery
                                        $res = mysqli_query($conn, $sql);

                                        //Count Rows to check whether we have categories or not
                                        $count = mysqli_num_rows($res);

                                        //IF count is greater than zero, we have categories else we donot have categories
                                        if($count>0)
                                        {
                                            //WE have categories
                                            while($row=mysqli_fetch_assoc($res))
                                            {
                                                //get the details of categories
                                                $category = $row['category'];
                                                $name = $row['name'];

                                                ?>

                                                <option value="<?php echo $category; ?>"><?php echo $name; ?></option>

                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            //WE do not have category
                                            ?>
                                            <option value="0">No Category Found</option>
                                            <?php
                                        }
                                        //2. Display on Drpopdown
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Name : </td>
                            <td>
                                <input type="text" name="name" placeholder="name of the Food">
                            </td>
                        </tr>

                        <tr>
                            <td>Price : </td>
                            <td>
                                <input type="number" name="price" placeholder="input price">
                            </td>
                        </tr>

                        <tr>
                            <td>Description : </td>
                            <td>
                                <textarea name="description" cols="50" rows="5" placeholder="Description of the Food."></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>Select Image : </td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Active : </td>
                            <td>
                                <input class="active" type="radio" name="active" value="Yes"> Yes 
                                <input class="active" type="radio" name="active" value="No"> No
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
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

<?php 
//CHeck whether the button is clicked or not
if(isset($_POST['submit']))
{
    //Add the Food in Database
    //echo "Clicked";
    //1. Get the DAta from Form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    if(isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
    else
    {
        $active = "No"; //Setting Default Value
    }
    //2. Upload the Image if selected
    //Check whether the select image is clicked or not and upload the image only if the image is selected
    if(isset($_FILES['image']['name']))
    {
        //Get the details of the selected image
        $image_name = $_FILES['image']['name'];
        //Check Whether the Image is Selected or not and upload image only if selected
        if($image_name!="")
        {
            // Image is SElected
            //A. REnamge the Image
            //Get the extension of selected image (jpg, png, gif, etc.) "vijay-thapa.jpg" vijay-thapa jpg
            $ext = end(explode('.', $image_name));
            // Create New Name for Image
            $image_name = rand(0000,9999).".".$ext; //New Image Name May Be "Food-Name-657.jpg"
            //B. Upload the Image
            //Get the Src Path and DEstinaton path
            // Source path is the current location of the image
            $src = $_FILES['image']['tmp_name'];
            //Destination Path for the image to be uploaded
            $dst = "../Assets/Images/all-menu/".$category."/".$image_name;
            //Finally Uppload the food image
            $upload = move_uploaded_file($src, $dst);
            //check whether image uploaded of not
            if($upload==false)
            {
                //Failed to Upload the image
                //REdirect to Add Food Page with Error Message
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                header('location:'.SITEURL.'Admin/add-food.php');
                //STop the process
                die();
            }
        }
    }
    else
    {
        $image_name = ""; //SEtting DEfault Value as blank
    }
    //3. Insert Into Database
    //Create a SQL Query to Save or Add food
    // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
    $sql2 = "INSERT INTO tbl_food SET 
        category = '$category',
        name = '$name',
        price = '$price',
        description = '$description',
        image_name = '$image_name',
        active = '$active'
    ";
    //Execute the Query
    $res2 = mysqli_query($conn, $sql2);
    //CHeck whether data inserted or not
    //4. Redirect with MEssage to Manage Food page
    if($res2==true)
    {
        //Query Executed and Category Added
        $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
        //Redirect to Manage Category Page
        header('location:'.SITEURL.'Admin/add-food.php');
    }
    else
    {
        //Failed to Add CAtegory
        $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
        //Redirect to Manage Category Page
        header('location:'.SITEURL.'Admin/add-food.php');
    }
}
?>