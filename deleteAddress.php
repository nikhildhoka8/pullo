<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once 'dbconnect.php';
    $addressId = $_GET['deliveryAddressId'];
    $stmt = $con->prepare('DELETE FROM DELIVERY_ADDRESS WHERE deliveryAddressId = ?');
    $stmt->execute([$addressId]);
    header('Location: ./custAddress.php');
}
else{
    header('Location: ./userProfile.php');
}
?>