<?php
include('../Config/config.php');

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
	header("Location: login.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = sha1($_POST['password']);
	$cpassword = sha1($_POST['cpassword']);

	if (isset($_FILES['image']['name'])) {
		// Mengambil detail foto profile yang di pilih
		$image_name = $_FILES['image']['name'];
		// Memeriksa gambar yang di pilih
		$checkimage = getimagesize($_FILES["image"]["tmp_name"]);
		if (!$checkimage == false) {
			if ($image_name != "") {
				// Foto di pilih
				// A. Mengganti nama gambar
				// Mendapatkan format gambar yang dipilih (jpg, png, gif, dll.) "vijay-thapa.jpg"
				$ext = end(explode('.', $image_name));
				// Membuat nama baru dengan format gambar yang sama 
				$image_name = rand(0000, 9999) . "." . $ext;
				// B. Mengunggah gambar
				// Mencari jalur penyimpanan gambar
				// Jalur penyimpanan gambar adalah lokasi gambar saat ini
				$src = $_FILES['image']['tmp_name'];
				// Jalur Tujuan untuk gambar yang akan diunggah
				$dst = "../Images/users/profile/" . $image_name;
				// Mengunggah gambar
				$upload = move_uploaded_file($src, $dst);
				// Memeriksa gambar berhasil di unggah atau tidak
				if ($upload == false) {
					// Gagal mengunggah gambar
					// Memberikan informasi bahwa gambar gagal di unggah
					echo "<script>alert('Failed to Upload Image.')</script>";
					//STop the process
					die();
				}

				//check pasword and add to database
				if ($password == $cpassword) {
					$sql = "SELECT * FROM tbl_users WHERE email='$email'";
					$result = mysqli_query($conn, $sql);
					if (!$result->num_rows > 0) {
						$sql = "INSERT INTO tbl_users (img_user, username, email, password)
									VALUES ('$image_name', '$username', '$email', '$password')";
						$result = mysqli_query($conn, $sql);
						if ($result) {
							echo "<script>alert('Wow! User Registration Completed.')</script>";
							$username = "";
							$email = "";
							$_POST['password'] = "";
							$_POST['cpassword'] = "";
						} else {
							echo "<script>alert('Woops! Something Wrong Went.')</script>";
						}
					} else {
						echo "<script>alert('Woops! Email Already Exists.')</script>";
					}
				} else {
					echo "<script>alert('Password Not Matched.')</script>";
				}
			}
		} else {
			echo "<script>alert('Failed to Upload Image.')</script>";
			$image_name = "";
		}
	} else {
		$image_name = ""; // Mereset image yang berhasil di unggah
		//check pasword and add to database
		if ($password == $cpassword) {
			$sql = "SELECT * FROM tbl_users WHERE email='$email'";
			$result = mysqli_query($conn, $sql);
			if (!$result->num_rows > 0) {
				$sql = "INSERT INTO tbl_users (img_user, username, email, password)
							VALUES ('$image_name', '$username', '$email', '$password')";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo "<script>alert('Wow! User Registration Completed.')</script>";
					$username = "";
					$email = "";
					$_POST['password'] = "";
					$_POST['cpassword'] = "";
				} else {
					echo "<script>alert('Woops! Something Wrong Went.')</script>";
				}
			} else {
				echo "<script>alert('Woops! Email Already Exists.')</script>";
			}
		} else {
			echo "<script>alert('Password Not Matched.')</script>";
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<!-- Title & Image In Tab Website -->
	<title>Register</title>
	<link rel="icon" href="../Images/LogoGresda.jpg">
	<!-- Template Main CSS File -->
	<link rel="stylesheet" href="style.css">
	<!-- Required Meta Tags -->
	<meta char set="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Font Awesome CDN Link  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
	<div class="container-register">
		<div class="header">
			<h2>Create Account</h2>
		</div>
		<form id="form" class="form" method="POST" enctype="multipart/form-data">
			<div class="upload-profile-image">
				<div class="upload-image">
					<img class="camera-icon" src="../Images/logo/camera-solid.svg" alt="camera">
					<img src="../Images/users/profile/default.png" class="img">
				</div>
				<small class="text-image">Choose Image</small>
				<input type="file" name="image" id="upload-profile">
			</div>
			<div class="form-control">
				<input type="text" name="username" placeholder="Username" value="" required>
			</div>
			<div class="form-control">
				<input type="email" name="email" placeholder="Email" value="" required>
			</div>
			<div class="form-control">
				<input type="password" name="password" placeholder="Password" value="" required>
			</div>
			<div class="form-control">
				<input type="password" name="cpassword" placeholder="Confirm Password" value="" required>
			</div>
			<button type="submit" name="submit" value="Send Now">Submit</button>
			<h3>Already have an account ? <a href="login.php">Sign in here</a></h3>
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

	<script src="script.js"></script>
</body>

</html>