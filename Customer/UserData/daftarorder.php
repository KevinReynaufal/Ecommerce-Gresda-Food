<?php
include('../../Assets/Config/config.php'); 
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {

	$uid = $_SESSION['id'];
	$uname = $_SESSION['username'];
	$caricart = mysqli_query($conn,"SELECT * from tbl_cart where user_id='$uid' and status='Cart'");
	$orderidd = mysqli_fetch_array($caricart);
	$itungtrans = mysqli_query($conn,"select count(order_id) as jumlahtrans from tbl_cart where user_id='$uid' and status!='Cart'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
	
    if(isset($_POST["update"])){
        $kode = $_POST['idproduknya'];
        $jumlah = $_POST['jumlah'];
        $q1 = mysqli_query($conn, "update tbl_detailorder set qty='$jumlah' where food_id='$kode' and order_id='$orderidd'");
        if($q1){
            echo "Berhasil Update Cart
            <meta http-equiv='refresh' content='1; url= cart.php'/>";
        } else {
            echo "Gagal update cart
            <meta http-equiv='refresh' content='1; url= cart.php'/>";
        }
    } else if(isset($_POST["hapus"])){
        $kode = $_POST['idproduknya'];
        $q2 = mysqli_query($conn, "delete from tbl_detailorder where food_id='$kode' and order_id='$orderidd'");
        if($q2){
            echo "Berhasil Hapus";
        } else {
            echo "Gagal Hapus";
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
		<h2>Hi <span><?php echo $uname ?></span>, in your order list there are : <span><?php echo $itungtrans3 ?></span> items</h2>
		<div class="icons">
            <i class="fas fa-user-cog" id="user">
                <div class="dropdown">
                    <a href="../UserSetting/update-profile.php">Profile</a>
                    <a href="../UserSetting/update-password.php">Setting</a>
                    <a href="../../Assets/Login-Register/logout.php">Logout</a>  
                </div>
            </i>
        </div>
    </header>

	<section class="cart">
		<table class="cart-table">
			<thead>
				<tr>
					<th>No.</th>	
					<th>Kode Order</th>
					<th>Tanggal Order</th>
					<th>Total</th>
					<th>Status</th>
				</tr>
			</thead>
			
			<?php 
				$brg=mysqli_query($conn,"SELECT DISTINCT(cart_id), c.order_id, tgl_order, status from tbl_cart c, tbl_detailorder d where c.user_id='$uid' and d.order_id=c.order_id and status!='Cart' order by tgl_order DESC");
				$no=1;
				while($b=mysqli_fetch_array($brg)){
			?>
			<tr class="rem1">
				<form method="POST">
					<td class="invert"><?php echo $no++ ?></td>
					<td class="invert"><a href="detailorder.php?id=<?php echo $b['order_id'] ?>"><?php echo $b['order_id'] ?></a></td>
					
					<td class="invert"><?php echo $b['tgl_order'] ?></td>
					<td class="invert">Rp<?php 	
										$ongkir = 10;
										$ordid = $b['order_id'];
										$result1 = mysqli_query($conn,"SELECT SUM(qty*price)+$ongkir AS count FROM tbl_detailorder d, tbl_food p where d.order_id='$ordid' and p.food_id=d.food_id order by d.food_id ASC");
										$cekrow = mysqli_num_rows($result1);
										$row1 = mysqli_fetch_assoc($result1);
										$count = $row1['count'];
										if($cekrow > 0){
											echo number_format($count);
											} else {
												echo 'No data';
											}?>.000
					</td>
					<td class="invert">
						<div class="rem">
							<?php
							if($b['status']=='Payment'){
							echo '<a href="confirmorder.php?id='.$b['order_id'].'" class="form-control btn-primary">Payment Confirmation</a>';
							}else if($b['status']=='Confirmed'){
								echo 'Order Is Being Processed';
							}else if($b['status']=='Delivery'){
								echo 'Order Is On The Way';
							}else if($b['status']=='Review'){
								echo '<a href="revieworder.php?id='.$b['order_id'].'" class="form-control btn-primary">Confirm The Order, And Make An Assessment</a>';
							}else if($b['status']=='Finished'){
								echo 'Order Complete';
							}else if($b['status']=='Canceled'){
								echo 'Order Canceled';
							}else {
								echo 'ERROR ( PLEASE CONTACT ADMIN )<br> WA : 082217265234';
							}
							?>
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
				</form>
			</tr>
			<?php
				}
			?>
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
		</table>
		<div class="checkout-left">	
			<div class="checkout-right-basket">
				<a href="../../index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
			</div>
		</div>
	</section>
</body>
</html>
<?php 
}else{
    header("Location:".SITEURL."index.php");
    exit();
}
?>