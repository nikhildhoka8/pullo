<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once 'dbconnect.php';
    $addressId = $_GET['deliveryAddressId'];
    $stmt = $con->prepare('UPDATE DELIVERY_ADDRESS SET activeStatus = FALSE WHERE deliveryAddressId = ?');
    $stmt->execute([$addressId]);
    header('Location: ./custAddress.php?message=Address Deleted Successfully');
}
else{
    header('Location: ./userProfile.php');
}
?>