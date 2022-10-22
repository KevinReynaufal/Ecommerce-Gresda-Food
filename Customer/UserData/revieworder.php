<?php
include('../../Assets/Config/config.php');

error_reporting(0);

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {

    $idorder = $_GET['id'];
    $uname = $_SESSION['username'];

    if (isset($_POST['submit'])) {
        $userid = $_SESSION['id'];
        $veriforderid = mysqli_query($conn, "SELECT * from tbl_cart where order_id='$idorder'");
        $fetch = mysqli_fetch_array($veriforderid);
        $liat = mysqli_num_rows($veriforderid);

        if ($fetch > 0) {
            $rating = $_POST['rating'];
            $message = $_POST['message'];
            $kon = mysqli_query($conn, "INSERT into tbl_review (order_id, user_id, rating, message, active) values ('$idorder','$userid','$rating','$message', 'Yes')");
            if ($kon) {
                $up = mysqli_query($conn, "UPDATE tbl_cart set status='Finished' where order_id='$idorder'");
                $_SESSION['user-review'] = "<div class='success'>Terima kasih telah melakukan Penilaian</div>";
                echo "<meta http-equiv='refresh' content='7; url= ../index.php'/> ";
            } else {
                $_SESSION['user-review'] = "<div class='error'>Gagal Submit, silakan ulangi lagi.</div>";
                echo "<meta http-equiv='refresh' content='3; url= revieworder.php?id=$idorder'/> ";
            }
        } else {
            $_SESSION['user-review'] = "<div class='error'>Kode Order tidak ditemukan</div>";
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    </head>

    <body class="confirmorder">
        <!-- Header Section Start -->
        <header>
            <h2>Hi <span><?php echo $uname ?></span>, do you want to review the product? ?
                <br><?php
                    if (isset($_SESSION['user-review'])) {
                        echo $_SESSION['user-review'];
                        unset($_SESSION['user-review']);
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
                <br><br><br>
                <div class="login-form-grids">
                    <form action="" method="POST">
                        <h4>Kode Order</h4>
                        <input type="text" name="orderid" value="<?php echo $idorder ?>" disabled>
                        <h5>Ranting</h5>
                        <div class="rateyo" id="rating" data-rateyo-rating="4.5" data-rateyo-num-stars="5" data-rateyo-score="4.5">
                        </div>
                        <input type="text" name="rating" placeholder="Please Click The Star To Make A Rating" value="Auto" disabled>
                        <input type="hidden" name="rating" value="4.5" required />
                        <h5>Review Message</h5>
                        <textarea type="text" name="message" placeholder="Give Your Review About Us In Here!" required></textarea>
                        <input type="submit" name="submit" value="submit" />
                        <h3>Do you want to cancel the Review? <a href="daftarorder.php">Click here</a></h3>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <script>
            $(function() {
                $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
                    var rating = data.rating;
                    $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
                    $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
                });
            });
        </script>
    </body>

    </html>
<?php
} else {
    header("Location:" . SITEURL . "index.php");
    exit();
}
?>