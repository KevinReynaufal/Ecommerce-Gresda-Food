<?php include('Assets/Config/config.php');
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    header("Location:" . SITEURL . "Customer/index.php");
} else {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <!-- Title & Image In Tab Website -->
        <title>Gresda Food & Beverage</title>
        <link rel="icon" href="Assets/Images/LogoGresda.jpg">
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
            <img src="Assets/Images/LogoGresdaFoodBeverage.jpg" class="logo">
            <nav class="navbar">
                <a class="active" href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#menu">Menu</a>
                <a href="#review">Review</a>
                <a href="#contact">Contact</a>
            </nav>
            <div class="icons">
                <i class="fas fa-bars" id="menu-bars"></i>
                <a href="Assets/Login-Register/login.php" class="fas fa-user"></a>
            </div>
        </header>

        <!-- Home Section Start -->
        <section class=" home" id="home">
            <div class="content">
                <div class="text-1">Welcome to</div>
                <div class="text-2">Gresda Food & Beverage</div>
                <a href="#menu" class="btn">Show Menu</a>
            </div>
        </section>

        <!-- About Section Start  -->
        <section class="about" id="about">
            <h1 class="sub-heading">About Us</h1>
            <div class="row">
                <div class="image">
                    <img src="Assets/Images/home-menu/01.png" alt="">
                </div>
                <div class="content">
                    <h2>Our Philosophy</h2>
                    <p> Gresda Food & Beverage adalah Restoran dengan harga terjangkau yang bisa dinikmati oleh seluruh
                        kalangan khususnya warga Bandung. Gresda Food & Beverage selalu berupaya untuk memberikan kepuasan
                        yang lebih daripada cukup kepada setiap pelanggan, mulai dari kepuasan terhadap pelayanan semenjak
                        konsumen datang, hingga konsumen meninggalkan restoran, sampai dengan kepuasan terhadap suasana
                        interaksi lainnya yang berada di area lingkungan Restoran.
                    </p>
                    <div class="icons-container">
                        <div class="icons">
                            <i class="fas fa-shipping-fast"></i>
                            <span>free delivery</span>
                        </div>
                        <div class="icons">
                            <i class="fas fa-dollar-sign"></i>
                            <span>easy payments</span>
                        </div>
                        <div class="icons">
                            <i class="fas fa-headset"></i>
                            <span>24/7 service</span>
                        </div>
                    </div>
                </div>
            </div>
            <span id="dots"></span>
            <span id="more">
                <div class="row">
                    <div class="content">
                        <h2>Gresda Story</h2>
                        <p> Gresda Food & Beverage adalah sebuah restoran yang baru saja didirikan oleh Kevin Reynaufal, dia
                            adalah seorang siswa SMK Telkom Bandung, dia membuat website ini di karenakan sebuah kegiatan
                            yang bernama PKL, gresda sendiri adalah nama sebuah keluarga kecil yang di dirikan di dalam
                            sebuah game roleplay.
                        </p>
                        <p>
                            Asal mula Gresda sendiri terinspirasi dari sebuah game GTA Roleplay yang di bawa ke dunia
                            real life, Gresda sendiri pada awalnya hanyalah beranggota 4 orang saja yaitu Kevin Reynaufal,
                            Robert Arsyah, Gavin Nafhan dan Ivan Haikal. Setelah sekian lama berdiri, Gresda Family memiliki
                            banyak anggota baru, yang pada akhirnya memiliki niat untuk membuka restoran yang dinamakan
                            Gresda Food & Beverage.
                        </p>
                    </div>
                    <div class="image">
                        <img src="Assets/Images/aesthetic/05.jpg" alt="">
                    </div>
                </div>
            </span>
            <i onclick="moreFunction()" id="moreBtn">Read more</i>
        </section>

        <!-- Menu Section Start  -->
        <section class="menu" id="menu">
            <h1 class="sub-heading">Our Menu</h1>
            <div class="select-box">
                <div class="list-menu">
                    <div class="option active" id="all-menu">
                        <button class="btn">All Menu</button>
                    </div>
                    <?php
                    // Create SQL Query to Display Categories from Database
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes' LIMIT 100";
                    //Execute the Query
                    $res = mysqli_query($conn, $sql);
                    //Count rows to check whether the category is available or not
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        //Categories Available
                        while ($row = mysqli_fetch_assoc($res)) {
                            //Get the Values like id, title, image_name
                            $name = $row['name'];
                            $category = $row['category'];
                    ?>
                            <div class="option" id="<?php echo $category; ?>">
                                <button class="btn"><?php echo $name; ?></button>
                            </div>
                    <?php
                        }
                    } else {
                        //Categories not Available
                        echo "<div class='error'>Category not Added.</div>";
                    }
                    ?>
                </div>
                <div class="selected"></div>
            </div>
            <div class="box-container">
                <?php
                // Create SQL Query to Display CAtegories from Database
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' ORDER BY rand() LIMIT 10000";
                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);
                //Count Rows
                $count2 = mysqli_num_rows($res2);
                //CHeck whether food available or not
                if ($count2 > 0) {
                    //Food Available
                    while ($row = mysqli_fetch_assoc($res2)) {
                        //Get all the values
                        $id = $row['food_id'];
                        $category = $row['category'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        $active = $row['active'];
                ?>
                        <div class="box <?php echo $category; ?> all-menu">
                            <div class="menu-card">
                                <div class="image">
                                    <?php
                                    //Check whether image available or not
                                    if ($image_name == "") {
                                        //Image not Available
                                        echo "<div class='error'>Image not available.</div>";
                                    } else {
                                        //Image Available
                                    ?>
                                        <img src="Assets/Images/all-menu/<?php echo $category; ?>/<?php echo $image_name; ?>" alt="">
                                        <div class="icons">
                                            <a class="fas fa-eye popup-btn"></a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="content">
                                    <h3><?php echo $name; ?></h3>
                                    <span class="price">IDR <?php echo $price; ?>K</span>
                                </div>
                            </div>
                            <div class="popup-view">
                                <div class="popup-card">
                                    <a><i class="fas fa-times close-btn"></i></a>
                                    <div class="product-img">
                                        <img src="Assets/Images/all-menu/<?php echo $category; ?>/<?php echo $image_name; ?>" alt="">
                                    </div>
                                    <div class="info">
                                        <h2><?php echo $name; ?></h2>
                                        <p><?php echo $description; ?></p>
                                        <span class="price">IDR <?php echo $price; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    //Food Not Available 
                    echo "<div class='error'>Food not available.</div>";
                }
                ?>
            </div>
            <div class="btn-showmore">
                <i class="showmore" id="showmore">Show More</i>
            </div>
        </section>

        <!-- Review Section Start  -->
        <section class="review" id="review">
            <h1 class="sub-heading">Guest Review</h1>
            <div class="swiper-container review-slider">
                <div class="swiper-wrapper">
                    <!--Profile card start-->
                    <?php
                    // Create SQL Query to Display CAtegories from Database
                    $sqlreview = "SELECT * FROM tbl_review r, tbl_users u WHERE active='Yes' and r.user_id=u.id ORDER BY rand() LIMIT 10000";
                    //Execute the Query
                    $resreview = mysqli_query($conn, $sqlreview);
                    //Count Rows
                    $countreview = mysqli_num_rows($resreview);
                    //CHeck whether food available or not
                    if ($countreview > 0) {
                        //Food Available
                        while ($row = mysqli_fetch_assoc($resreview)) {
                            //Get all the values
                            $userid = $row['user_id'];
                            $imguser = $row['img_user'];
                            $username = $row['username'];
                            $rating = $row['rating'];
                            $message = $row['message'];
                            $active = $row['active'];
                    ?>
                            <div class="swiper-slide card">
                                <div class="profile-image">
                                    <img src="Assets/Images/users/profile/<?php echo $imguser; ?>" alt="">
                                </div>
                                <div class="card-content uid_<?php echo $userid; ?>">
                                    <h3><?php echo $username; ?></h3>
                                    <div class="stars">
                                        <div class="stars-outer">
                                            <div class="stars-inner"></div>
                                        </div>
                                    </div>
                                    <p><?php echo $message; ?></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    <?php
                    } else {
                        //Food Not Available 
                        echo "<div class='error'>Review Not Available.</div>";
                    }
                    ?>
                </div>
                <script>
                    // Initial Ratings
                    const ratings = {
                        uid_4: 5,
                        uid_3: 4.5,
                        uid_2: 4.0,
                        uid_1: 4.0,
                        uid_5: 3.5,
                        uid_10: 5,
                        uid_7: 4.5,
                        uid_9: 4.0,
                        uid_8: 4.0,
                        uid_56: 3.5,
                        elserate: 0.0
                    }
                    // Total Stars
                    const starsTotal = 5;

                    // Run getRatings when DOM loads
                    document.addEventListener('DOMContentLoaded', getRatings);

                    // Rating control change
                    ratingControl.addEventListener('blur', (e) => {
                        const rating = e.target.value;

                        getRatings();
                    });

                    // Get ratings
                    function getRatings() {
                        for (let rating in ratings) {
                            // Get percentage
                            const starPercentage = (ratings[rating] / starsTotal) * 100;

                            // Round to nearest 10
                            const starPercentageRounded = `${Math.round(starPercentage / 10) * 10}%`;

                            // Set width of stars-inner to percentage
                            document.querySelector(`.${rating} .stars-inner`).style.width = starPercentageRounded;

                        }
                    }
                </script>
            </div>
            <div class="swiper-pagination"> </div>
        </section>

        <!-- Contact Section Start -->
        <section class="contact" id="contact">
            <h1 class="sub-heading">Contact Us</h1>
            <form method="POST" class="contact">
                <div class="container">
                    <div class="content">
                        <div class="left-side">
                            <div class="address details">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="topic">Address</div>
                                <div class="text-one">Jawa Barat - Bandung</div>
                                <div class="text-one">Kecamatan Baleendah</div>
                            </div>
                            <div class="phone details">
                                <i class="fas fa-phone-alt"></i>
                                <div class="topic">Phone</div>
                                <div class="text-one">+62 822 1726 5234</div>
                                <div class="text-two">+62 812 2157 4374</div>
                            </div>
                            <div class="email details">
                                <i class="fas fa-envelope"></i>
                                <div class="topic">Email</div>
                                <div class="text-one">gresdafood69@gmail.com</div>
                                <div class="text-two">gresdaclothes99@gmail.com</div>
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="topic-text">Send us a message</div>
                            <p>If you have any questions about the menu or any questions related to our restaurant, you can
                                message me from here. I'm happy to help you.</p>
                            <div class="input-box">
                                <input type="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="input-box">
                                <input type="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box message-box">
                                <textarea type="message" name="message" placeholder="Enter your message" rows="10" required></textarea>
                            </div>
                            <input class="button" type="submit" name="submit" value="Send Now">
                        </div>
                    </div>
                </div>
            </form>
            <?php
            //CHeck whether submit button is clicked or not
            if (isset($_POST['submit'])) {
                $customer_name = $_POST['name'];
                $customer_email = $_POST['email'];
                $customer_message = $_POST['message'];

                //Save the Order in Databaase
                //Create SQL to save the data
                $sql2 = "INSERT INTO tbl_contact SET 
                        customer_name = '$customer_name',
                        customer_email = '$customer_email',
                        customer_message = '$customer_message'
                    ";

                //echo $sql2; die();

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether query executed successfully or not
                if ($res2 == true) {
                    //Query Executed and Order Saved
                    echo "<script>alert('Delivered Message Successfully.')</script>";
                } else {
                    //Failed to Save Order
                    echo "<script>alert('Failed to Delivered Message.')</script>";
                }
            }
            ?>
        </section>

        <!-- Footer Section Start -->
        <footer class="footer" id="footer">
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; Copyright of <strong>someone</strong> you don't know
                </div>
                <div class="credits">Designed by <a href="https://smktelkom-bdg.sch.id/">Gresda Community</a>
                </div>
            </div>
        </footer>

        <!-- Back-To-Top Section Start -->
        <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

        <!-- loader Section Starts -->
        <!-- <div class="loader-container">
        <img src="Images/WebLoader.gif" alt="">
    </div> -->

        <!-- jQuery Core 3.6.0 -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <!-- Custom JS File Link  -->
        <script src="script.js"></script>
    </body>

    </html>
<?php
}
?>