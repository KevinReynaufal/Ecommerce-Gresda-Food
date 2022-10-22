<?php 
	include('../../Assets/Config/config.php'); 

	if (isset($_SESSION['user'])) {
		header("Location: ../index.php");
	}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Title & Image In Tab Website -->
    <title>Login</title>
    <link rel="icon" href="../../images/LogoGresda.jpg">
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
			<h2>Login Administrator</h2>
		</div>
		<form id="form" class="form" method="POST">
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
			<div class="form-control">
				<input type="text" name="username" placeholder="Enter Username">
			</div>
			<div class="form-control">
				<input type="password" name="password" placeholder="Enter Password">
			</div>
			<button type="submit" name="submit" value="Send Now">Submit</button><br>
		</form>
	</div>
</body>
</html>

<?php 
    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);
        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        //3. Execute the Query
        $res = mysqli_query($conn, $sql);
        //4. COunt rows to check whether the user exists or not
        $count = mysqli_num_rows($res);
        if($count==1) {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'Admin/');
        } else {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'Admin/Assets/login.php');
        }
    }
?>