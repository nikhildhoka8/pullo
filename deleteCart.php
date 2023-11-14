<?php
// Delete a product from the cart based on the cartId from the query string
session_start();
require_once 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once 'dbconnect.php';
    $cartId = $_GET['cartId'];
    $stmt = $con->prepare('DELETE FROM CART WHERE cartId = ?');
    $stmt->execute([$cartId]);
    header('Location: ./cart.php?message=Product Deleted Successfully');
}
else{
    header('Location: ./userProfile.php');
}

?>