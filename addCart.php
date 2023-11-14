<?php
session_start();
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['size']) && isset($_GET['productId'])) {
        $size = htmlspecialchars($_GET['size']);
        $productId = htmlspecialchars($_GET['productId']);
        $stmt = $con->prepare("INSERT INTO CART (userId, productId, sizeId, quantity) VALUES (:userId, :productId, :sizeId, 1);");
        $stmt->bindParam(':userId', $_SESSION['userId']);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':sizeId', $size);
        $stmt->execute();
        header('Location: cart.php');
    } else {
        // Handle case when size or productId is not set
        header('Location: index.php');
        exit(); // Stop script execution after redirect
    }
} else {
    // Handle case when the request method is not GET
    print "Error: Invalid Request";
    header('Location: index.php');
    exit(); // Stop script execution after redirect
}
?>
