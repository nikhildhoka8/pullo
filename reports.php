<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Download Reports</title>
</head>
<body class="main-layout">
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php
        require_once 'adminSecondNav.php';
    ?>
    <!-- Make 4 Buttons. These buttons let the admin donwload the various reports -->
    <div class = "form-container">
        <form action="" method = "">
        <a class="btn btn-primary" href="./downloadAllData.php">Download All Data</a><br><br>
        <a class="btn btn-primary" href="./downloadAllOrder.php">Download All Orders</a><br><br>
        <a class="btn btn-primary" href="./downloadAllProduct.php">Download All Products</a><br><br>
        <a class="btn btn-primary" href="./downloadAllStock.php">Download All Stock</a><br><br>
        </form>
    </div>
    <?php require_once 'footerNav.php';?>
</body>
</html>