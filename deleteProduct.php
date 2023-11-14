<?php
session_start();
require_once 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once 'dbconnect.php';
    $productId = $_GET['productId'];
    $stmt = $con->prepare('UPDATE PRODUCT SET activeStatus = FALSE WHERE productId = ?');
    $stmt->execute([$productId]);
    header('Location: ./viewProducts.php?message=Product Deleted Successfully');
}
else{
    header('Location: ./userProfile.php');
}
?>