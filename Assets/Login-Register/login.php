<?php
include('../Config/config.php');

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
	header("Location: ../../Customer/index.php");
}

if (isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$raw_password = sha1($_POST['password']);
	$password = mysqli_real_escape_string($conn, $raw_password);

	$sql = "SELECT * FROM tbl_users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['id'] = $row['id'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['username'] = $row['username'];
		header("Location: ../../Customer/index.php");
	} else {
		echo "<script>alert('Woops! email or Password is Wrong.')</script>";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<!-- Title & Image In Tab Website -->
	<title>Login</title>
	<link rel="icon" href="../images/LogoGresda.jpg">
	<!-- Template Main CSS File -->
	<link rel="stylesheet" href="style.css">
	<!-- Required Meta Tags -->
	<meta char set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Font Awesome CDN Link  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
	<div class="container-login">
		<div class="header">
			<h2>Login Account</h2>
		</div>
		<form id="form" class="form" method="POST">
			<div class="form-control">
				<input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
			</div>
			<div class="form-control">
				<input type="password" name="password" placeholder="Password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<button type="submit" name="submit" value="Send Now">Submit</button>
			<h3>Don't have an account ? <a href="register.php">Sign Up here</a></h3>
		</form>
	</div>
</body>

</html>