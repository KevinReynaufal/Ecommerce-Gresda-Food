<?php

include('../../Assets/Config/config.php');

error_reporting(0);

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $uname = $_SESSION['username'];
    //1. Get the ID of Selected Admin

    //2. Create SQL Query to Get the Details
    $sql = "SELECT * FROM tbl_users WHERE id='$id' and username='$uname'";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query is executed or not
    if ($res == true) {
        // Check whether the data is available or not
        $count = mysqli_num_rows($res);
        //Check whether we have admin data or not
        if ($count == 1) {
            // Get the Details
            //echo "Admin Available";
            $row = mysqli_fetch_assoc($res);

            $username = $row['username'];
            $email = $row['email'];
            $current_image = $row['img_user'];
        } else {
            //Redirect to Manage Admin PAge
            header('location:' . SITEURL . 'Assets/Login-Register/logout.php');
        }
    }

?>

    <head>
        <!-- Title & Image In Tab Website -->
        <title>User Settings</title>
        <link rel="icon" href="../../Assets/Images/LogoGresda.jpg">
        <!-- Template Main CSS File -->
        <link rel="stylesheet" href="style.css">
        <!-- Required Meta Tags -->
        <meta char set="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Font Awesome CDN Link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h2>Update Profile</h2>
            </div>
            <form id="form" class="form" action="" method="POST" enctype="multipart/form-data">
                <?php
                if (isset($_SESSION['change-profile'])) {
                    echo $_SESSION['change-profile'];
                    unset($_SESSION['change-profile']);
                }
                ?>
                <div class="upload-profile-image">
                    <div class="upload-image">
                        <img class="camera-icon" src="../../Assets/Images/logo/camera-solid.svg" alt="camera">
                        <img src="../../Assets/Images/users/profile/<?php echo $current_image ?>" class="img">
                    </div>
                    <small class="text-image">Choose Image</small>
                    <input type="file" name="image" id="upload-profile">
                </div>
                <div class="form-control">
                    <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                </div>
                <div class="form-control">
                    <input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <button type="submit" name="submit" value="Send Now">Submit</button>
                <h3>Back to main page ? <a href="../../index.php">Click here</a></h3>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

        <script src="script.js"></script>

    </body>

    </html>

<?php
    //Check whether the Submit Button is Clicked or not
    if (isset($_POST['submit'])) {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $current_image = $_POST['current_image'];

        if (isset($_FILES['image']['name'])) {
            //Get the details of the selected image
            $image_name = $_FILES['image']['name'];
            //Check Whether the Image is Selected or not and upload image only if selected
            $checkimage = getimagesize($_FILES["image"]["tmp_name"]);
            if (!$checkimage == false) {
                if ($image_name != "") {
                    // Image is SElected
                    //A. REnamge the Image
                    //Get the extension of selected image (jpg, png, gif, etc.) "vijay-thapa.jpg" vijay-thapa jpg
                    $ext = end(explode('.', $image_name));
                    // Create New Name for Image
                    $image_name = rand(0000, 9999) . "." . $ext; //New Image Name May Be "Food-Name-657.jpg"
                    //B. Upload the Image
                    //Get the Src Path and DEstinaton path
                    // Source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];
                    //Destination Path for the image to be uploaded
                    $dst = "../../Assets/Images/users/profile/" . $image_name;
                    //Finally Uppload the food image
                    $upload = move_uploaded_file($src, $dst);
                    //check whether image uploaded of not
                    if ($upload == false) {
                        //Failed to Upload the image
                        //REdirect to Add Food Page with Error Message
                        $_SESSION['upload-image'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location: update-profile.php');
                        //STop the process
                        die();
                    }
                    if ($current_image != "") {
                        //Current Image is Available
                        //REmove the image
                        $remove_path = "../../Assets/Images/users/profile/" . $current_image;

                        $remove = unlink($remove_path);

                        //Check whether the image is removed or not
                        if ($remove == false) {
                            //failed to remove current image
                            $_SESSION['upload-image'] = "<div class='error'>Faile to remove current image.</div>";
                            //redirect to manage food
                            header('location: update-profile.php');
                            //stop the process
                            die();
                        }
                        //Create a SQL Query to Update Admin
                        $sql = "UPDATE tbl_users SET
                            img_user = '$image_name',
                            username = '$username',
                            email = '$email'
                            WHERE id='$id'
                            ";

                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Check whether the query executed successfully or not
                        if ($res == true) {
                            //Query Executed and Admin Updated
                            $_SESSION['change-profile'] = "<div class='success'>Profile Updated Successfully.</div>";
                            //Redirect to Manage Admin Page
                            header('location:' . SITEURL . 'Customer/UserSetting/update-profile.php');
                        } else {
                            //Failed to Update Admin
                            $_SESSION['change-profile'] = "<div class='error'>Profile Updated Faled</div>";
                            //Redirect to Manage Admin Page
                            header('location:' . SITEURL . 'Customer/UserSetting/update-profile.php');
                        }
                    }
                }
            } else {
                $image_name = $current_image; //Default Image when Image is Not Selected
            }
        }
    } else {
        $image_name = $current_image; //SEtting DEfault Value as blank
        //Create a SQL Query to Update Admin
        $sql = "UPDATE tbl_users SET
            img_user = '$image_name',
            username = '$username',
            email = '$email'
            WHERE id='$id'
            ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if ($res == true) {
            //Query Executed and Admin Updated
            $_SESSION['change-profile'] = "<div class='success'>Profile Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:' . SITEURL . 'Customer/UserSetting/update-profile.php');
        } else {
            //Failed to Update Admin
            $_SESSION['change-profile'] = "<div class='error'>Profile Updated Faled</div>";
            //Redirect to Manage Admin Page
            header('location:' . SITEURL . 'Customer/UserSetting/update-profile.php');
        }
    }
} else {
    header("Location:" . SITEURL . "Customer/index.php");
}

?>