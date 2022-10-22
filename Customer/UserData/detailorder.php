<?php 
include('../../Assets/Config/config.php'); 
error_reporting(0);
if(isset($_SESSION['username']) &&isset($_SESSION['id']))
{
?>

<?php 
	$uid = $_SESSION['id'];
	$uname = $_SESSION['username'];
    $orderid = $_GET['id'];
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
		<h2>Hi <span><?php echo $uname ?></span>, your order id is : <span><?php echo $orderid ?></span>
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

	<section class="cart">
		<table class="cart-table">
			<thead>
				<tr>
					<th>No</th>	
					<th>Picture</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				<tr class="rem1"><form method="post">
				<?php 
				$brg=mysqli_query($conn,"SELECT * from tbl_detailorder d, tbl_food f where order_id='$orderid' and d.food_id=f.food_id");
				$no=1;
				while($b=mysqli_fetch_array($brg)){
				?>
					<td class="invert"><?php echo $no++ ?></td>
					<td class="invert">
						<img src="../../Assets/Images/all-menu/<?php echo $b['category'] ?>/<?php echo $b['image_name'] ?>"/>
					</td>
					<td class="invert"><?php echo $b['name'] ?></td>
					<td class="invert"><?php echo $b['qty'] ?></td>
					<td class="invert">IDR <?php echo number_format($b['price']) ?>K</td>
				</form></tr>
				<?php
				}
				?>
			</tbody>
		</table>
        <br>
        <table class="cart-table">
			<thead>
				<tr>
					<th>No</th>	
					<th>Bukti Pembayaran</th>
					<th>Payment</th>
					<th>Rekening Name</th>
					<th>Alamat</th>
                    <th>Tanggal Pay</th>
					<th>Tanggal Submit</th>
				</tr>
			</thead>
			<tbody>
				<tr class="rem1"><form method="post">
				<?php 
				$brg=mysqli_query($conn,"SELECT * from tbl_confirmorder where order_id='$orderid'");
				$no=1;
				while($b=mysqli_fetch_array($brg)){
				?>
					<td class="invert"><?php echo $no++ ?></td>
                    <td class="invert">
                        <img src="../../Assets/Images/users/payment/<?php echo $b['image_name'] ?>"/>
					</td>
					<td class="invert"><?php echo $b['payment'] ?></td>
					<td class="invert"><?php echo $b['rekening_name'] ?></td>
					<td class="invert"><?php echo $b['alamat'] ?></td>
                    <td class="invert"><?php echo $b['tgl_pay'] ?></td>
                    <td class="invert"><?php echo $b['tgl_submit'] ?></td>
				</form></tr>
				<?php
				}
				?>
			</tbody>
		</table>

		<div class="checkout-left">	
            <div class="checkout-left-basket">
				<h4>Total Harga</h4>
				<ul>
					<?php 
					$brg=mysqli_query($conn,"SELECT * from tbl_detailorder d, tbl_food f where order_id='$orderid' and d.food_id=f.food_id order by d.food_id ASC");
					$no=1;
					$subtotal = 10000;
					while($b=mysqli_fetch_array($brg)){
					$hrg = $b['price'].'000';
					$qtyy = $b['qty'];
					$totalharga = $hrg * $qtyy;
					$subtotal += $totalharga
					?>
					<li><?php echo $b['name']?><i> x <?php echo number_format($qtyy)?> </i> <span>Rp <?php echo number_format($totalharga) ?> </span></li>
					<?php
					}
					?>
					<li class="total-harga">Total (include. 10k Ongkir)<i></i> <span>Rp <?php echo number_format($subtotal) ?></span></li>
				</ul>
			</div>
			<div class="checkout-right-basket">
                <a href="../../index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To Home</a>
				<a href="daftarorder.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To Order List</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</section>
</body>
</html>
<?php 
} else {
    header("Location:".SITEURL."Customer/index.php");
}
 ?>
