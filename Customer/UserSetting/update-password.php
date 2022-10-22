<?php

include('../../Assets/Config/config.php');

error_reporting(0);

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
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
                <h2>Change Password</h2>
            </div>
            <form id="form" class="form" action="" method="POST">
                <?php
                if (isset($_SESSION['change-pass'])) {
                    echo $_SESSION['change-pass'];
                    unset($_SESSION['change-pass']);
                }
                ?>
                <div class="form-control">
                    <input type="password" name="current_password" placeholder="Current Password" required>
                </div>
                <div class="form-control">
                    <input type="password" name="new_password" placeholder="New Password" required>
                </div>
                <div class="form-control">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="submit" value="Send Now">Submit</button>
                <h3>Back to main page ? <a href="../../index.php">Click here</a></h3>
            </form>
        </div>
    </body>

    </html>

<?php
    //CHeck whether the Submit Button is Clicked on Not
    if (isset($_POST['submit'])) {
        //echo "CLicked";

        //1. Get the DAta from Form
        $id = $_POST['id'];
        $current_password = sha1($_POST['current_password']);
        $new_password = sha1($_POST['new_password']);
        $confirm_password = sha1($_POST['confirm_password']);


        //2. Check whether the user with current ID and Current Password Exists or Not
        $sql = "SELECT * FROM tbl_users WHERE id=$id AND password='$current_password'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            //CHeck whether data is available or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //User Exists and Password Can be CHanged
                //echo "User FOund";

                //Check whether the new password and confirm match or not
                if ($new_password == $confirm_password) {
                    //Update the Password
                    $sql2 = "UPDATE tbl_users SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //CHeck whether the query exeuted or not
                    if ($res2 == true) {
                        //Display Succes Message
                        //REdirect to Manage Admin Page with Success Message
                        echo "<script>alert('Password Changed Successfully.')</script>";
                        //Redirect the User
                    } else {
                        //Display Error Message
                        //REdirect to Manage Admin Page with Error Message
                        $_SESSION['change-pass'] = "<div class='error'>Failed to Change Password. </div>";
                        header('location:' . SITEURL . 'Customer/Assets/UserSetting/update-password.php');
                        //Redirect the User
                    }
                } else {
                    //REdirect to Manage Admin Page with Error Message
                    $_SESSION['change-pass'] = "<div class='error'>New password doesn't Match </div>";
                    header('location:' . SITEURL . 'Customer/Assets/UserSetting/update-password.php');
                    //Redirect the User

                }
            } else {
                //User Does not Exist Set Message and REdirect
                $_SESSION['change-pass'] = "<div class='error'>Old password doesn't Match. </div>";
                header('location:' . SITEURL . 'Customer/Assets/UserSetting/update-password.php');
                //Redirect the User
            }
        }
    }
} else {
    header("Location:" . SITEURL . "Customer/index.php");
}
?>