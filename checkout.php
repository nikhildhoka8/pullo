<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Checkout</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    
</head>
<body class="main-layout">

<!-- Header section -->
<div class="header_section header_main">
    <?php require_once 'headerNav.php';?>
</div>

<!-- Checkout Form -->
<div class="collection_text">Checkout</div>

<form action="process_order.php" method="post">
    <!-- Add fields for shipping information (e.g., name, address, etc.) -->
    <label for="name">Name: Nikhil</label><br>

    <label for="address">Address:</label><br>
    <textarea id="address" name="address" required></textarea><br>
    <!-- Show Total -->
    <label>Total:<?php 
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $total += $value['price'] * $value['quantity'];
    }
    print $total?></label><br>
    <!-- Button to proceed with the checkout -->
    <button type="submit">Proceed to Payment</button>
</form>

<!-- Footer section -->
<?php require_once 'footerNav.php';?>

</body>
</html>
