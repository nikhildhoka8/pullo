<?php
session_start();
require_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>error</title>
</head>
<body class="main-layout">
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php
    if(isset($_SESSION['userId'])){
        if($_SESSION['userType'] == '1'){
            require_once 'custSecondNav.php';
        }else if($_SESSION['userType'] == '2'){
            require_once 'adminSecondNav.php';
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['message'])){
            echo '<div class="alert alert-danger" role="alert">'.$_GET['message'].'</div>';
        }
    }
    ?>
    
    <?php require_once 'footerNav.php';?>
</body>
</html>