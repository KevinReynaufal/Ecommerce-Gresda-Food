<?php 
    include('../Assets/Config/config.php'); 
    include('Assets/login-check.php');
?>
<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected Food
        $sql2 = "SELECT * FROM tbl_food WHERE food_id=$id";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected Food
        $name = $row2['name'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category'];
        $active = $row2['active'];

    }
    else
    {
        //Redirect to Manage Food
        header('location:'.SITEURL.'Admin/manage-food.php');
    }
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
                <span class="dashboard">Update Food</span>
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
                                        //Query to Get ACtive Categories
                                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                        //Execute the Query
                                        $res = mysqli_query($conn, $sql);
                                        //Count Rows
                                        $count = mysqli_num_rows($res);
                                        //Check whether category available or not
                                        if($count>0)
                                        {
                                            //CAtegory Available
                                            while($row=mysqli_fetch_assoc($res))
                                            {
                                                $category_name = $row['name'];
                                                $category_id = $row['category'];
                                                //echo "<option value='$category_id'>$category_title</option>";
                                                ?>
                                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            //CAtegory Not Available
                                            echo "<option value='0'>Category Not Available.</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Name : </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $name; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Price : </td>
                            <td>
                                <input type="number" name="price" value="<?php echo $price; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Description : </td>
                            <td>
                                <textarea name="description" cols="50" rows="5"><?php echo $description; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Current Image : </td>
                            <td>
                                <?php 
                                    if($current_image == "")
                                    {
                                        //Image not Available 
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>Assets/Images/all-menu/<?php echo $current_category; ?>/<?php echo $current_image; ?>" width="150px">
                                        <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Select New Image : </td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Active : </td>
                            <td>
                                <input <?php if($active=="Yes") {echo "checked";} ?> class="active" type="radio" name="active" value="Yes"> Yes 
                                <input <?php if($active=="No") {echo "checked";} ?> class="active" type="radio" name="active" value="No"> No 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
        
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";

        //1. Get all the details from the form
        $id = $_POST['id'];
        $category = $_POST['category'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $current_image = $_POST['current_image'];
        $active = $_POST['active'];

        //2. Upload the image if selected

        //CHeck whether upload button is clicked or not
        if(isset($_FILES['image']['name']))
        {
            //Upload BUtton Clicked
            $image_name = $_FILES['image']['name']; //New Image NAme

            //CHeck whether th file is available or not
            if($image_name!="")
            {
                //IMage is Available
                //A. Uploading New Image

                //REname the Image
                $ext = end(explode('.', $image_name)); //Gets the extension of the image

                $image_name = rand(0000,9999).".".$ext; //THis will be renamed image

                //Get the Source Path and DEstination PAth
                $src_path = $_FILES['image']['tmp_name']; //Source Path
                $dest_path = "../Assets/Images/all-menu/".$category."/".$image_name; //DEstination Path

                //Upload the image
                $upload = move_uploaded_file($src_path, $dest_path);

                /// CHeck whether the image is uploaded or not
                if($upload==false)
                {
                    //FAiled to Upload
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                    //REdirect to Manage Food 
                    header('location:'.SITEURL.'Admin/manage-food.php');
                    //Stop the Process
                    die();
                }
                //3. Remove the image if new image is uploaded and current image exists
                //B. Remove current Image if Available
                if($current_image!="")
                {
                    //Current Image is Available
                    //REmove the image
                    $remove_path = "../Assets/Images/all-menu/".$current_category."/".$current_image;

                    $remove = unlink($remove_path);

                    //Check whether the image is removed or not
                    if($remove==false)
                    {
                        //failed to remove current image
                        $_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
                        //redirect to manage food
                        header('location:'.SITEURL.'Admin/manage-food.php');
                        //stop the process
                        die();
                    }
                    
                }
            }
            else
            {
                $image_name = $current_image; //Default Image when Image is Not Selected
            }
        }
        else
        {
            $image_name = $current_image; //Default Image when Button is not Clicked
        }

        

        //4. Update the Food in Database
        $sql3 = "UPDATE tbl_food SET 
            category = '$category',
            name = '$name',
            price = '$price',
            description = '$description',
            image_name = '$image_name',
            active = '$active'
            WHERE food_id=$id
        ";

        //Execute the SQL Query
        $res3 = mysqli_query($conn, $sql3);

        //CHeck whether the query is executed or not 
        if($res3==true)
        {
            //Query Exectued and Food Updated
            $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
        }
        else
        {
            //Failed to Update Food
            $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
        }

        
    }
    
    ?>