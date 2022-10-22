<?php
include('../../Assets/Config/config.php'); 

error_reporting(0);

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    
    $idorder = $_GET['id'];
	$uname = $_SESSION['username'];

    if(isset($_POST['submit']))
	{
		$userid = $_SESSION['id'];
		$veriforderid = mysqli_query($conn,"select * from tbl_cart where order_id='$idorder'");
		$fetch = mysqli_fetch_array($veriforderid);
		$liat = mysqli_num_rows($veriforderid);
		
		if($fetch>0){
		$nama = $_POST['nama'];
		$metode = $_POST['metode'];
		$tanggal = $_POST['tanggal'];
		$alamat = $_POST['alamat'];

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
					$dst = "../../Assets/Images/users/payment/".$image_name;
					//Finally Uppload the food image
					$upload = move_uploaded_file($src, $dst);
					//check whether image uploaded of not
					if($upload==false)
					{
						//Failed to Upload the image
						//REdirect to Add Food Page with Error Message
						$_SESSION['upload-image'] = "<div class='error'>Failed to Upload Image.</div>";
						header('location: confirmorder.php?id='.$idorder);
						//STop the process
						die();
					}
				}
			} else {
				$image_name = ""; //SEtting DEfault Value as blank
			}

			$kon = mysqli_query($conn,"INSERT into tbl_confirmorder (order_id, user_id, payment, rekening_name, image_name, alamat, tgl_pay) values ('$idorder','$userid','$metode','$nama','$image_name','$alamat','$tanggal')");
			if ($kon){
				$up = mysqli_query($conn,"update tbl_cart set status='Confirmed' where order_id='$idorder'");
				$_SESSION['confirm-order'] = "<div class='success'>Terima kasih telah melakukan konfirmasi, Team kami akan melakukan konfirmasi. Informasi selanjutnya akan dikirim via Email</div>";
				echo "<meta http-equiv='refresh' content='7; url= ../index.php'/> ";
			} else { 
				$_SESSION['confirm-order'] = "<div class='error'>Gagal Submit, silakan ulangi lagi.</div>";
				echo "<meta http-equiv='refresh' content='3; url= confirmorder.php?id=$idorder'/> ";
			}
		} else {
			$_SESSION['confirm-order'] = "<div class='error'>Kode Order tidak ditemukan</div>";
			echo "<meta http-equiv='refresh' content='4; url= daftarorder.php'/> ";
		}
	};
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Title & Image In Tab Website -->
		<title>Gresda Food & Beverage</title>
		<link rel="icon" href="../../Assets/Images/LogoGresda.jpg">
		<!-- Template Main CSS File -->
		<link rel="stylesheet" href="style.css">
		<!-- Required Meta Tags -->
		<meta char set="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Font Awesome CDN Link  -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	</head>
	
<body class="confirmorder">
	<!-- Header Section Start -->
    <header>
		<h2>Hi <span><?php echo $uname ?></span>, do you want to confirm payment ?
		<br><?php 
            if(isset($_SESSION['upload-image']))
            {
                echo $_SESSION['upload-image'];
                unset($_SESSION['upload-image']);
            }
            if(isset($_SESSION['confirm-order']))
            {
                echo $_SESSION['confirm-order'];
                unset($_SESSION['confirm-order']);
            }
            ?>
		</h2>
		<div class="icons">
            <i class="fas fa-user-cog" id="user">
                <div class="dropdown">
                    <a href="../UserSetting/update-profile.php">Profile</a>
                    <a href="../UserSetting/update-password.php">Setting</a>
                    <a href="daftarorder.php">My Order</a>
                    <a href="../../Assets/Login-Register/logout.php">Logout</a>  
                </div>
            </i>
        </div>
    </header>

	<div class="register">
		<div class="container">
			<div class="login-form-grids">
				<form action="" method="POST" enctype="multipart/form-data">
					<h4>Kode Order</h4>
					<input type="text" name="orderid" value="<?php echo $idorder ?>" disabled>
					<h5>Rekening Tujuan</h5>
					<select name="metode" class="form-control">
						<?php
						$metode = mysqli_query($conn,"select * from tbl_payment");
						while($a=mysqli_fetch_array($metode)){
						?>
							<option value="<?php echo $a['metode'] ?>"><?php echo $a['metode'] ?> | <?php echo $a['rekening_number'] ?></option>
							<?php
						};
						?>
					</select>
					<h5>Tanggal Bayar</h5>	
					<input type="date" class="form-control" name="tanggal">
					<h5>Informasi Pembayaran</h5>
					<input type="text" name="nama" placeholder="Nama Pemilik Rekening / Sumber Dana" required>
					<input type="file" name="image">
					<h5>Alamat Pengiriman</h5>
					<input type="text" name="alamat" placeholder="Kota / Kabupaten - Alamat pengiriman - RT / RW" required>
					<input type="submit" name="submit" value="submit"/>
					<h3>Do you want to cancel the payment? <a href="daftarorder.php">Click here</a></h3>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php 
}else{
    header("Location:".SITEURL."index.php");
    exit();
}
?>