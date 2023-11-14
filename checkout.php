<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
// 1. Check if the user is logged in. If not, redirect to error.php with a message
if (!isset($_SESSION['userId']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: error.php?message=Invalid Request!');
    exit();
}
//2. get all the details of the cart and add it to the ORDER_TABLE. Also add the Shipping address ID and the Billing Address ID. Also add the payment method ID. Also add the user ID. Also add the order date. set the default statusId to 1
$stmt = $con->prepare("SELECT * FROM CART WHERE userId = ?");
$stmt->execute([$_SESSION['userId']]);
$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
$deliveryAddressId = $_POST['shippingAdd'];
$billingAddressId = $_POST['billingAdd'];
$paymentMethodId = $_POST['paymentMethod'];
$userId = $_SESSION['userId'];
$orderDate = date("Y-m-d");
$statusId = 1;

//Log all the details for the Payment Details and then get the PaymentDetailId, and the total amount
$amount = 0;
foreach ($cart as $item) {
    $productId = $item['productId'];
    $quantity = $item['quantity'];
    $stmt = $con->prepare("SELECT * FROM PRODUCT WHERE productId = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $price = $product['price'];
    $amount += $price * $quantity;
}
$stmt = $con->prepare("INSERT INTO PAYMENT_DETAIL (paymentMethodId, paymentDate, paymentStatusId, amount) VALUES (:paymentMethodId, :paymentDate, 1, :amount)");
$stmt->bindParam(':paymentMethodId', $paymentMethodId);
$stmt->bindParam(':paymentDate', $orderDate);
$stmt->bindParam(':amount', $amount);
$stmt->execute();
$paymentDetailId = $con->lastInsertId("paymentDetailId");

//3. Loop through the items in the cart and then add it to the ORDER_TABLE. Also add the size of the product
foreach ($cart as $item) {
    $productId = $item['productId'];
    $sizeId = $item['sizeId'];
    $quantity = $item['quantity'];
    $stmt = $con->prepare("INSERT INTO ORDER_TABLE (productId, sizeId, quantity, deliveryAddressId, billingAddressId, paymentDetailId, userId, orderDate, statusId) VALUES (:productId, :sizeId, :quantity, :deliveryAddressId, :billingAddressId, :paymentDetailId, :userId, :orderDate, :statusId)");
    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':sizeId', $sizeId);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':deliveryAddressId', $deliveryAddressId);
    $stmt->bindParam(':billingAddressId', $billingAddressId);
    $stmt->bindParam(':paymentDetailId', $paymentDetailId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':orderDate', $orderDate);
    $stmt->bindParam(':statusId', $statusId);
    $stmt->execute();
}
//4. Delete all the items from the cart
$stmt = $con->prepare("DELETE FROM CART WHERE userId = ?");
$stmt->execute([$_SESSION['userId']]);
//Delete the Items from the STOCK table
foreach ($cart as $item) {
    $productId = $item['productId'];
    $sizeId = $item['sizeId'];
    $quantity = $item['quantity'];
    $stmt = $con->prepare("UPDATE STOCK SET quantity = quantity - :quantity WHERE productId = :productId AND sizeId = :sizeId");
    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':sizeId', $sizeId);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->execute();
}
//5. Redirect to the orderHistory.php page with a message
header('Location: orderHistory.php?message=Order placed successfully.');

?>
