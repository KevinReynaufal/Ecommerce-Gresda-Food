<?php
include('../../Assets/Config/config.php');
error_reporting(0);
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
	$uid = $_SESSION['id'];
	$uname = $_SESSION['username'];
	$caricart = mysqli_query($conn, "select * from tbl_cart where user_id='$uid' and status='Cart'");
	$fetc = mysqli_fetch_array($caricart);
	$orderidd = $fetc['order_id'];
	$itungtrans = mysqli_query($conn, "select count(detail_id) as jumlahtrans from tbl_detailorder where order_id='$orderidd'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];

	if (isset($_POST["checkout"])) {
		$q3 = mysqli_query($conn, "UPDATE tbl_cart SET status='Payment' where order_id='$orderidd'");
		if ($q3) {
			$_SESSION['user-checkout-update'] = "<div class='success'>Successfully Placed An Order</div>";
			echo "<meta http-equiv='refresh' content='1; url= daftarorder.php'/>";
		} else {
			$_SESSION['user-checkout-update'] = "<div class='error'>Failed to Place An Order</div>";
			echo "<meta http-equiv='refresh' content='1; url= checkout.php'/>";
		}
	} else {
	}
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

	<body>
		<!-- Header Section Start -->
		<header>
			<h2>Hi <span><?php echo $uname ?></span>, do you want to continue checkout ? with a total of <span><?php echo $itungtrans3 ?> items</span>
				<br><?php
					if (isset($_SESSION['user-checkout-update'])) {
						echo $_SESSION['user-checkout-update'];
						unset($_SESSION['user-checkout-update']);
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

		<!-- checkout -->

		<section class="cart">
			<table class="cart-table">
				<thead>
					<tr>
						<th>No.</th>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total</th>
					</tr>
				</thead>

				<?php
				$brg = mysqli_query($conn, "SELECT * from tbl_detailorder d, tbl_food p where order_id='$orderidd' and d.food_id=p.food_id order by d.food_id ASC");
				$no = 1;
				while ($b = mysqli_fetch_array($brg)) {

				?>
					<tbody>
						<tr>
							<form method="post">
								<td class="invert"><?php echo $no++ ?></td>
								<td class="invert"><?php echo $b['name'] ?></td>
								<td class="invert">
									<div class="quantity">
										<div class="quantity-select">
											<h4><?php echo $b['qty'] ?></h4>
										</div>
									</div>
								</td>
								<td class="invert">Rp <?php echo number_format($b['price']) ?>.000</td>
								<td class="invert">Rp <?php echo number_format($b['price'] * $b['qty']) ?>.000</td>
						</tr>

						<!-- <tr>
					<td colspan="4">Order Code</td>  
					<td><?php echo $orderidd ?></td>  
				</tr> -->
						</form>
					<?php
				}
					?>
					<tr>
						<?php
						$brg = mysqli_query($conn, "SELECT * from tbl_detailorder d, tbl_food f where order_id='$orderidd' and d.food_id=f.food_id order by d.food_id ASC");
						$no = 1;
						$subtotal = 10000;
						while ($b = mysqli_fetch_array($brg)) {
							$hrg = $b['price'] . '000';
							$qtyy = $b['qty'];
							$totalharga = $hrg * $qtyy;
							$subtotal += $totalharga
						?>
						<?php
						}
						?>
						<td colspan="4" letter-spacing="3px">Sub Total (include. 10k Ongkir)</td>
						<td>Rp <?php echo number_format($subtotal) ?></td>
					</tr>
					</tbody>
			</table>
			<div class="information"><br><br>
				<div class="payment-method">
					<?php
					$metode = mysqli_query($conn, "select * from tbl_payment");
					while ($p = mysqli_fetch_array($metode)) {
					?>
						<div>
							<img src="../../Assets/Images/payment/<?php echo $p['image_name'] ?>" width="130px"><br>
							<h4><?php echo $p['metode'] ?> - <?php echo $p['rekening_number'] ?><br>a/n. <?php echo $p['an'] ?></h4>
						</div>
					<?php
					}
					?>
				</div>
				<br><br>
				<h3>Orderan anda Akan Segera kami proses Setelah Anda Melakukan Pembayaran dan menyertakan
					informasi pribadi seperti Nama Pemilik Rekening / Sumber Dana, Tanggal Pembayaran,
					Metode Pembayaran dan Jumlah Bayar.</h3><br>
			</div>
			<form method="post">
				<input type="submit" class="btn-success" name="checkout" value="I Agree and Check Out" \>
			</form>
		</section>
		<!-- //checkout -->
	</body>

	</html>
<?php
} else {
	header("Location:" . SITEURL . "Customer/index.php");
}
?>