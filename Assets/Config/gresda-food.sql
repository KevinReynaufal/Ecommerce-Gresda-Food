-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2022 pada 09.19
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gresda-food`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(10) UNSIGNED NOT NULL,
  `order_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_id` int(10) NOT NULL,
  `tgl_order` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'Cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `order_id`, `user_id`, `tgl_order`, `status`) VALUES
(1, '16Vo00TG/HmNk', 1, '2021-10-11 13:54:52', 'Finished'),
(2, '16vdIcBp7Hphk', 2, '2021-10-11 14:32:06', 'Finished'),
(3, '167DsCrbudjuo', 3, '2021-10-11 14:40:32', 'Finished'),
(4, '16Irghp0ni8EA', 4, '2021-10-11 15:15:53', 'Finished');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 NOT NULL,
  `active` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `category`, `active`) VALUES
(1, 'Prime Steak', 'prime-steak', 'Yes'),
(2, 'Speciality Steak', 'speciality-steak', 'Yes'),
(3, 'Western Delight', 'western-delight', 'Yes'),
(4, 'Burger', 'burger', 'Yes'),
(5, 'Soup Salad', 'soup-salad', 'Yes'),
(6, 'Light Meal', 'light-meal', 'Yes'),
(7, 'Dessert', 'dessert', 'Yes'),
(13, 'Drink', 'drink', 'Yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_confirmorder`
--

CREATE TABLE `tbl_confirmorder` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_id` int(10) NOT NULL,
  `payment` varchar(10) CHARACTER SET utf8 NOT NULL,
  `rekening_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tgl_pay` date NOT NULL,
  `tgl_submit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_confirmorder`
--

INSERT INTO `tbl_confirmorder` (`id`, `order_id`, `user_id`, `payment`, `rekening_name`, `image_name`, `alamat`, `tgl_pay`, `tgl_submit`) VALUES
(1, '16Vo00TG/HmNk', 1, 'Bank BCA', 'Kevin Reynaufal', '4196.png', 'Komplek baleendah permai blok Z no 5', '2021-10-11', '2021-10-11 13:56:08'),
(2, '16vdIcBp7Hphk', 2, 'Bank BNI', 'Irfan Rizky', '3095.png', 'Komplek Baleendah Permai Jalan Padi Endah 5 No 200 RT 03/RW 25', '2021-10-11', '2021-10-11 14:34:22'),
(3, '167DsCrbudjuo', 3, 'Bank BRI', 'Fahri Arsyah', '6399.png', 'Jl Cibuntu Selatan RT 02 / RW 10', '2021-10-11', '2021-10-11 14:41:51'),
(4, '16Irghp0ni8EA', 4, 'Dana', 'Naufal Andya', '3038.png', 'JL. Wuluku No 24', '2021-10-11', '2021-10-11 15:17:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `customer_email` varchar(150) CHARACTER SET utf8 NOT NULL,
  `customer_message` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `customer_name`, `customer_email`, `customer_message`) VALUES
(1, 'Kevin Reynaufal', 'kevinreynaufal2004@gmail.com', 'Hallo... ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detailorder`
--

CREATE TABLE `tbl_detailorder` (
  `detail_id` int(10) UNSIGNED NOT NULL,
  `order_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `food_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detailorder`
--

INSERT INTO `tbl_detailorder` (`detail_id`, `order_id`, `food_id`, `qty`) VALUES
(1, '16Vo00TG/HmNk', 9, 1),
(2, '16Vo00TG/HmNk', 18, 1),
(3, '16vdIcBp7Hphk', 16, 1),
(4, '16vdIcBp7Hphk', 12, 1),
(5, '167DsCrbudjuo', 2, 1),
(6, '167DsCrbudjuo', 11, 1),
(7, '16Irghp0ni8EA', 3, 1),
(8, '16Irghp0ni8EA', 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_food`
--

CREATE TABLE `tbl_food` (
  `food_id` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `active` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_food`
--

INSERT INTO `tbl_food` (`food_id`, `category`, `name`, `price`, `description`, `image_name`, `active`) VALUES
(1, 'prime-steak', 'Aussie Lamb Chop', '30', 'Grill Imported Australian Lamb Chop Served With Butter On Top, Rosemary, Lemon Wedges, Choices Of Potato, Vegetable, And Sauce. 250GR', '9362.jpg', 'Yes'),
(2, 'prime-steak', 'Norwegian Salmon Steak', '35', 'Grilled Imported Norwegian Salmon Served With Butter On Top, Rosemary, Lemon Wedges, Choices Of Potato, Vegetable And White Mushroom Sauce. 200GR', '1782.jpg', 'Yes'),
(3, 'prime-steak', 'US Short Ribs BBQ', '35', 'Grilled imported US short ribs glazed with our homemade sauce served with choices of potato, vegetable, and Korean barbeque sauce. 300GR ', '4161.jpg', 'Yes'),
(4, 'prime-steak', 'Sirloin Meltique Wagyu', '40', 'Grilled sirloin meltique wagyu served with butter on top, rosemary, lemon wedges, choices of potato, vegetable and sauce. 200GR', '7260.jpg', 'Yes'),
(5, 'prime-steak', 'Rib Eye Meltique Wagyu', '40', 'Grilled rib eye meltique wagyu served with butter on top, rosemary, lemon wedges, choices of potato, vegetable and sauce. 200GR', '480.jpg', 'Yes'),
(6, 'prime-steak', 'Tenderloin Meltique Wagyu ', '45', 'Grilled tenderloin meltique wagyu served with butter on top, rosemary, lemon wedges, choices of potato, vegetable and sauce. 200GR', '1733.jpg', 'Yes'),
(7, 'prime-steak', 'US Black Angus Sirloin Steak', '45', 'Grilled imported US black angus sirloin served with butter on top, rosemary, lemon wedges, choices of potato, vegetable and sauce. 200GR', '3724.jpg', 'Yes'),
(8, 'prime-steak', 'US Black Angus Rib Eye Steak', '50', 'Grilled imported US black angus rib eye served with butter on top, rosemary, lemon wedges, choices of potato, vegetable and sauce. 200GR', '3616.jpg', 'Yes'),
(9, 'prime-steak', 'US Black Angus Tenderloin Steak', '50', 'Grilled imported US black angus tenderloin served with butter on top, rosemary, lemon wedges, choices of potato, vegetable and sauce. 200GR', '6350.jpg', 'Yes'),
(10, 'speciality-steak', 'Aussie Tenderloin Grain Fed', '45', 'Grilled imported Aussie tenderloin served with choices of potato, vegetable and sauce. 250GR', '3761.jpg', 'Yes'),
(11, 'speciality-steak', 'Garlic Roasted Chicken', '45', 'It’s cut in a half 350gr garlic roasted chicken with our signature recipe served with choices of potato, vegetable and sauce.', '7372.jpg', 'Yes'),
(12, 'speciality-steak', 'Aussie Sirloin Cheese Steak', '60', 'Grilled imported Aussie sirloin 150gr topped with mushroom, smoked beef, mozzarella served with choices of potato, vegetable and sauce.', '7645.jpg', 'Yes'),
(13, 'speciality-steak', 'American Mix Grill', '65', 'Grilled imported Aussie sirloin, boneless chicken breast, beef bratwurst, lamb chop served with choices of potato, vegetable and sauce.', '586.jpg', 'Yes'),
(14, 'speciality-steak', 'Seafood Platter', '85', 'Grilled lobster, imported Norwegian salmon and dory served with choices of potato, vegetable and white mushroom sauce.', '900.jpg', 'Yes'),
(15, 'speciality-steak', 'Surf & Turf', '125', 'Grilled imported Aussie tenderloin 250gr and lobster 300gr served with choices of potato, vegetable and white mushroom sauce.', '1794.jpg', 'Yes'),
(16, 'speciality-steak', 'Garlic Butter Lobster', '110', '600gr aromatic garlic butter lobster served with choices of potato, vegetable and combine with white mushroom sauce.', '4468.jpg', 'Yes'),
(17, 'speciality-steak', 'Family BBQ / For 4 Person', '180', '2 Slices Aussie Sirloin Steak, 2 pcs Dory Crispy, 4 Slices Grilled Chicken, 4 pcs Beef Bratwurst, served with 4 kind of sauce (Mushroom, Blackpepper, Barbeque, White Mushroom Sauce) Choices of Potato (French Fries / Wedges Potato), Choices of Vegetable (Balsamic Salad / Mix Vegetable) and 4 Iced Lemon Tea.', '1097.jpg', 'Yes'),
(18, 'speciality-steak', 'Meat Lovers Platter / For 6 Person', '280', '2 Slices Aussie Tenderloin Steak, 2 Slices Aussie Sirloin Steak, 4 Slices Aussie Patty Steak, 4 pcs Beef Bratwurst served with 3 Kind of sauce (Blackpepper, Mushroom, Barbeque), Choices of Potato (French Fries / Wedges Potato) Choices of Vegetable (Balsamic Salad / Mix Vegetable) and 6 Iced Lemon Tea.', '4640.jpg', 'Yes'),
(19, 'western-delight', 'Beef Pizzaiola', '40', 'Breaded tenderloin topping mozarella cheese, caramelized onion and smoked beef, served with choices of potato, vegetable and sauce .', '7290.jpg', 'Yes'),
(20, 'western-delight', 'Beef Cordon Bleu', '40', 'Breaded tenderloin filling with mozzarella cheese and smoked beef served with choices of potato, vegetable and sauce.', '913.jpg', 'Yes'),
(21, 'western-delight', 'Beef Schnitzel', '40', 'Breaded tenderloin, sunny side up, served with choices of potato, vegetable and sauce.', '8513.jpg', 'Yes'),
(22, 'western-delight', 'American Fish & Chip', '50', 'Batter fillet dory crispy topped with mozzarella cheese served with choices of potato, vegetable and tartar sauce.', '8540.jpg', 'Yes'),
(23, 'western-delight', 'John Dory', '40', 'Breaded fillet dory 150 gr, served with choices of potato, vegetable and tartar sauce .', '3717.jpg', 'Yes'),
(24, 'western-delight', 'Chicken Pizzaiola', '37', 'Breaded boneless chicken leg topped with mozzarella cheese, caramelized onion and smoked beef served with choices of potato, vegetable and sauce.', '9348.jpg', 'Yes'),
(25, 'western-delight', 'Chicken Cordon Bleu', '35', 'Breaded boneless chicken breast filling with mozzarella cheese and smoked beef, served with choices of potato, vegetable and sauce.', '2497.jpg', 'Yes'),
(26, 'western-delight', 'Fish Me To The Moon', '35', 'Breaded fillet dory filling with mozzarella cheese and smoked beef, served with choices of potato, vegetable and sauce.', '9026.jpg', 'Yes'),
(27, 'western-delight', 'Chicken Maryland', '35', 'Breaded boneless chicken leg served with choices of potato, vegetable and sauce.', '8674.jpg', 'Yes'),
(28, 'burger', 'Teriyaki Burger', '25', 'Burger bun, chicken teriyaki, vegetable, mayonnaise and caramelized onion served with choices of potato.', '2699.jpg', 'Yes'),
(29, 'burger', 'Grill Chicken Burger', '25', 'Brown burger bun, grilled chicken, American cheese, vegetables, caramelized onion, barbeque sauce, and mayonnaise, served with choices of potato .', '2672.jpg', 'Yes'),
(30, 'burger', 'Ohio Fish Burger', '25', 'Burger bun, fillet dory crispy, American cheese, vegetable, caramelized onion, tartar sauce served with choices of potato.', '3361.jpg', 'Yes'),
(31, 'burger', 'Old Fashioned Beef Burger', '30', 'Burger bun, double beef patty, triple American cheese, vegetable, caramelized onion, barbeque sauce and mayonnaise, served with choices of potato.', '1985.jpg', 'Yes'),
(32, 'burger', 'Sloppy Joe Burger', '30', 'Burger bun, double beef patty, American cheese, vegetable, caramelized onion, sloppy joe sauce and mayonnaise served with choices of potato.', '238.jpg', 'Yes'),
(33, 'burger', 'American Burger', '30', 'Burger bun, double beef patty, double American cheese, smoked beef, sunny side up, vegetable, barbeque sauce and mayonnaise served with choices of potato.', '5887.jpg', 'Yes'),
(34, 'soup-salad', 'Chicken Cream Soup', '15', 'Cream soup with chicken and corn kernel served with garlic bread.', '2146.jpg', 'Yes'),
(35, 'soup-salad', 'Smoked Beef Cream Soup', '15', 'Cream soup with smoked beef and corn kernel served with garlic bread.', '5558.jpg', 'Yes'),
(36, 'soup-salad', 'Organic Garden Salad', '15', 'Organic mix lettuce, dressing with balsamic, topped with smoke beef sliced, parmesan cheese served with garlic bread', '1763.jpg', 'Yes'),
(37, 'prime-steak', 'Caesar Chicken Salad', '20', 'Organic romaine lettuce, grilled chicken, boiled egg, caesar dressing, parmesan cheese served with garlic bread.', '4568.jpg', 'Yes'),
(38, 'soup-salad', 'US Prawn Salad', '25', 'Organic lettuce, dressing with balsamic topped with grilled US prawn, parmesan cheese served with garlic bread.', '6562.jpg', 'Yes'),
(39, 'soup-salad', 'Beef Salad', '25', 'Organic lettuce, dressing with balsamic topped wih sauted beef, and parmesan cheese and served with garlic bread.', '7584.jpg', 'Yes'),
(40, 'light-meal', 'French Fries', '15', 'Fried potato straight cut 200gr.', '2960.jpg', 'Yes'),
(41, 'light-meal', 'Chili Cheese Fries', '20', 'French fries topped with bolognese sauce and American cheese.', '4478.jpg', 'Yes'),
(42, 'light-meal', 'Chili Cheese Nachos', '20', 'Corn tortilla topped with bolognese sauce and American cheese.', '2860.jpg', 'Yes'),
(43, 'light-meal', 'Fish & Chips', '23', 'Batter fillet dory crispy served with french fries, lemon wedges and tartar sauce.', '971.jpg', 'Yes'),
(44, 'light-meal', 'Hot Wings', '23', 'Fried chicken wings served with french fries and Korean barbeque sauce.', '430.jpg', 'Yes'),
(45, 'light-meal', 'Sausage & Fries', '25', 'Beef bratwurst served with french fries and barbeque sauce.', '271.jpg', 'Yes'),
(46, 'dessert', 'Banana Split', '15', '3 scoops ice cream, peach, cavendish topped with whipped cream and granola.', '2504.jpg', 'Yes'),
(47, 'dessert', 'Brownies Cheezie Sundae', '15', 'Our homemade cheese brownies served with vanilla ice cream.', '1877.jpg', 'Yes'),
(48, 'dessert', 'Fruity Granola', '25', 'Granola, peach, strawberry, cavendish, dragon fruit served with honey and fresh milk.', '4567.jpg', 'Yes'),
(49, 'drink', 'Midnight B2uty', '13', 'Korean squash rasa Lychee & Grape', '2014.jpg', 'Yes'),
(50, 'drink', 'Exotic Kiss', '13', 'Korean squash rasa Lime', '3956.jpg', 'Yes'),
(51, 'drink', 'Blackjack Fire', '13', 'Korean squash rasa Bubblegum', '3556.jpg', 'Yes'),
(52, 'drink', 'Inspirit Destiny', '13', 'Korean squash rasa Huneydew & Mango', '5834.jpg', 'Yes'),
(53, 'drink', 'Boice Intuition', '13', 'Korean squash rasa Vanila', '514.jpg', 'Yes'),
(54, 'drink', 'Bulletproof Army', '13', 'Korean squash rasa Honeydew & Strawberry', '6700.jpg', 'Yes'),
(55, 'drink', 'Electric f(x)', '13', 'Korean squash rasa Blueberry & Lime', '4250.jpg', 'Yes'),
(56, 'drink', 'Sone Fantasy', '13', 'Korean squash rasa Strawberry', '6912.jpg', 'Yes'),
(57, 'drink', 'I Got7 Love', '13', 'Korean squash rasa Lemon & Strawberry', '8590.jpg', 'Yes'),
(58, 'prime-steak', 'Hottest Legend', '13', 'Korean squash rasa Blue Pineapple', '7951.jpg', 'Yes'),
(59, 'drink', 'Elf Miracle', '13', 'Korean squash rasa Blueberry', '6208.jpg', 'Yes'),
(60, 'drink', 'Shawol Oxygen', '13', 'Korean squash rasa Lychee', '3693.jpg', 'Yes'),
(61, 'drink', 'Daisy Twinkle', '13', 'Korean squash rasa Respberry', '1762.jpg', 'Yes'),
(62, 'drink', 'Lively Vip', '13', 'Korean squash rasa Lemon', '8277.jpg', 'Yes'),
(63, 'drink', 'Super Starlight', '13', 'Korean squash rasa Grape & Blue Curacao', '1216.jpg', 'Yes'),
(64, 'drink', 'Blink on Fire', '13', 'Korean squash rasa Strawberry Mocca', '8704.jpg', 'Yes'),
(65, 'drink', 'Oh My Carat', '13', 'Korean squash rasa Cotton Candy', '6224.jpg', 'Yes'),
(66, 'drink', 'Once Likey', '13', 'Korean squash rasa Strawberry Lime', '9211.jpg', 'Yes'),
(67, 'drink', 'Baby Aroha', '13', 'Korean squash rasa Respberry Lime', '1092.jpg', 'Yes'),
(68, 'drink', 'Summer Buddy', '13', 'Korean squash rasa Rose Berry', '9538.jpg', 'Yes'),
(69, 'drink', 'Wannable Boomerang', '13', 'Korean squash rasa Lemon & Mango', '2471.jpg', 'Yes'),
(70, 'drink', 'Limitless NCTzen', '13', 'Korean squash rasa Honeydew & Pineapple', '9912.jpg', 'Yes'),
(71, 'drink', 'Ikonic Bling', '13', 'Korean squash rasa Fruit Punch', '2309.jpg', 'Yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `metode` varchar(25) CHARACTER SET utf8 NOT NULL,
  `rekening_number` varchar(25) CHARACTER SET utf8 NOT NULL,
  `image_name` text CHARACTER SET utf8 NOT NULL,
  `an` varchar(25) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `metode`, `rekening_number`, `image_name`, `an`) VALUES
(1, 'Bank BCA', '12345678', 'bca.png', 'Gresda Food'),
(2, 'Bank BNI', '23456781', 'bni.png', 'Gresda Food'),
(3, 'Bank BRI', '34567812', 'bri.png', 'Gresda Food'),
(4, 'Dana', '45678123', 'dana.png', 'Gresda Food'),
(5, 'Gopay', '56781234', 'gopay.png', 'Gresda Food'),
(6, 'ShopeePay', '67812345', 'shopeepay.png', 'Gresda Food');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_review`
--

CREATE TABLE `tbl_review` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_id` int(10) NOT NULL,
  `rating` decimal(10,1) NOT NULL,
  `tgl_review` date DEFAULT current_timestamp(),
  `message` varchar(280) CHARACTER SET utf8 NOT NULL,
  `active` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_review`
--

INSERT INTO `tbl_review` (`id`, `order_id`, `user_id`, `rating`, `tgl_review`, `message`, `active`) VALUES
(1, '16Vo00TG/HmNk', 1, '1.0', '2021-10-11', 'Waktu datang kesini udah langsung di sambut pelayan yang ramah, trus hidangan makananya juga enak, ditambah suasana dan pemandangan yang indah, Serasa makan di restoran mahal...', 'Yes'),
(2, '16vdIcBp7Hphk', 2, '4.5', '2021-10-11', 'Pertama diajakin sama pacar kesini kirain menu nya bakal mahal karena vibes tempatnya yang classy banget, ehh ternyata menu nya murah murah dan enak. Pokoknya recomended banget inimah,', 'Yes'),
(3, '167DsCrbudjuo', 3, '4.5', '2021-10-11', 'Awalnya saya ragu sih karena ini rumah makan yang bisa di bilang high, setelah saya dan mantan saya melihat menu ternyata harganya sangat murah sekali dan makanan nya pun enak, akhirnya restoran ini adalah tempat terakhir saya dan mantan saya berjalan berdua, ', 'Yes'),
(4, '16Irghp0ni8EA', 4, '4.5', '2021-10-11', 'Pelayanannya cukup cepat tidak membuat kita menunggu terlalu lama, dan untuk makanan disini cukup enak hanya saja kurang banyak karena saya anak kost :)', 'Yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `img_user` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(150) CHARACTER SET utf8 NOT NULL,
  `email` varchar(150) CHARACTER SET utf8 NOT NULL,
  `password` varchar(150) CHARACTER SET utf32 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `img_user`, `username`, `email`, `password`) VALUES
(1, '1731.jpg', 'Kevin Reynaufal', 'kevinreynaufal2004@gmail.com', '802d3be54d783f4bc3ebcfd38dc0a1b9ffa1ef3d'),
(2, '1759.jpg', 'Irfan Rizqy ', 'irfanrizqy123@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, '9622.jpg', 'Fahri Arsyah', 'fahriarsyah123@gmail.com', '202cb962ac59075b964b07152d234b70'),
(4, '6078.jpg', 'Naufal Andya', 'naufalandya123@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_confirmorder`
--
ALTER TABLE `tbl_confirmorder`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_detailorder`
--
ALTER TABLE `tbl_detailorder`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indeks untuk tabel `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indeks untuk tabel `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_confirmorder`
--
ALTER TABLE `tbl_confirmorder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_detailorder`
--
ALTER TABLE `tbl_detailorder`
  MODIFY `detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `food_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
