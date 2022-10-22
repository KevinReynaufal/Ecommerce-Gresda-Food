<?php 
include('../../Assets/Config/config.php'); 
error_reporting(0);
if(isset($_SESSION['username']) &&isset($_SESSION['id']))
{
?>

<?php 
	$uid = $_SESSION['id'];
	$uname = $_SESSION['username'];
	$caricart = mysqli_query($conn,"SELECT * from tbl_cart where user_id='$uid' and status='Cart'");
	$fetc = mysqli_fetch_array($caricart);
	$orderidd = $fetc['order_id'];
	$itungtrans = mysqli_query($conn,"SELECT count(detail_id) as jumlahtrans from tbl_detailorder where order_id='$orderidd'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];

	if(isset($_POST["update"])){
		$kode = $_POST['idproduknya'];
		$jumlah = $_POST['jumlah'];
		$q1 = mysqli_query($conn, "update tbl_detailorder set qty='$jumlah' where food_id='$kode' and order_id='$orderidd'");
		if($q1){
			$_SESSION['user-cart-update'] = "<div class='success'>Successfully Update Cart.</div>";
			echo "<meta http-equiv='refresh' content='1; url= cart.php'/>";
		} else {
			$_SESSION['user-cart-update'] = "<div class='error'>Failed to Update Cart.</div>";
			echo "<meta http-equiv='refresh' content='1; url= cart.php'/>";
		}
	} else if(isset($_POST["hapus"])){
		$kode = $_POST['idproduknya'];
		$q2 = mysqli_query($conn, "delete from tbl_detailorder where food_id='$kode' and order_id='$orderidd'");
		if($q2){
			$_SESSION['user-cart-update'] = "<div class='success'>Successfully Removed Product From Cart</div>";
			echo "<meta http-equiv='refresh' content='1; url= cart.php'/>";
		} else {
			$_SESSION['user-cart-update'] = "<div class='error'>Failed to Remove Product From Cart</div>";
			echo "<meta http-equiv='refresh' content='1; url= cart.php'/>";
		}
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
		<h2>Hi <span><?php echo $uname ?></span>, in your cart there are : <span><?php echo $itungtrans3 ?> items</span>
		<br><?php 
		if(isset($_SESSION['user-cart-update']))
		{
			echo $_SESSION['user-cart-update'];
			unset($_SESSION['user-cart-update']);
		} 
		?></h2>
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
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
				<tr class="rem1"><form method="post">
				<?php 
				$brg=mysqli_query($conn,"SELECT * from tbl_detailorder d, tbl_food f where order_id='$orderidd' and d.food_id=f.food_id");
				$no=1;
				while($b=mysqli_fetch_array($brg)){
				?>
					<td class="invert"><?php echo $no++ ?></td>
					<td class="invert">
						<img src="../../Assets/Images/all-menu/<?php echo $b['category'] ?>/<?php echo $b['image_name'] ?>"/>
					</td>
					<td class="invert"><?php echo $b['name'] ?></td>
					<td class="invert">
						<div class="quantity"> 
							<div class="quantity-select">                     
								<input type="number" name="jumlah" class="form-control" value="<?php echo $b['qty'] ?>" \>
							</div>
						</div>
					</td>
					<td class="invert">IDR <?php echo number_format($b['price']) ?>K</td>
					<td class="invert">
						<div class="action">
							<input type="submit" name="update" class="form-control" value="Update" \>
							<input type="hidden" name="idproduknya" value="<?php echo $b['food_id'] ?>" \>
							<input type="submit" name="hapus" class="form-control" value="Hapus" \>
						</div>
						<script>$(document).ready(function(c) {
							$('.close1').on('click', function(c){
								$('.rem1').fadeOut('slow', function(c){
									$('.rem1').remove();
									});
								});	  
							});
						</script>
					</td>
				</form></tr>
				<?php
				}
				?>
			</tbody>
		</table>

		
		<div class="checkout-left">	
			<?php
			if($itungtrans3>0){
			?>
			<div class="checkout-left-basket">
				<h4>Total Harga</h4>
				<ul>
					<?php 
					$brg=mysqli_query($conn,"SELECT * from tbl_detailorder d, tbl_food f where order_id='$orderidd' and d.food_id=f.food_id order by d.food_id ASC");
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
			<?php
			} else {
			}
			?>
			<div class="checkout-right-basket">
				<a href="../../index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
				<?php
				if($itungtrans3>0){
					echo "<a href='checkout.php'><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span>Checkout</a>";
				}else {
				}
				?>
			</div>
			<div class="clearfix"></div>
		</div>
	</section>
	<!--quantity-->
	<script>
		$('.value-plus').on('click', function(){
			var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
			divUpd.text(newVal);
		});

		$('.value-minus').on('click', function(){
			var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
			if(newVal>=1) divUpd.text(newVal);
		});
		</script>
	<!--quantity-->
</body>
</html>
<?php 
} else {
    header("Location:".SITEURL."Customer/index.php");
}
 ?>
