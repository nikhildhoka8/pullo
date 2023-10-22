<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Profile</title>
</head>
<body class="main-layout">
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php
    if(isset($_SESSION['user'])){
        if($_SESSION['userType'] == '1'){
            require_once 'custSecondNav.php';
        }else if($_SESSION['userType'] == '2'){
            require_once 'adminSecondNav.php';
        }
    }
    ?>
    <div class = "form-container">
        <form action="" method "">
    
        </form>
    </div>
    <?php require_once 'footerNav.php';?>
</body>
</html>