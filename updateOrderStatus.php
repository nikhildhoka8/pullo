<?php

use function PHPSTORM_META\type;

session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Update Order Status</title>
</head>
<body class="main-layout">
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php
        require_once 'adminSecondNav.php';
        if(isset($_GET['orderId'])){
            $orderId = $_GET['orderId'];
            $stmt = $con->prepare("SELECT * FROM VW_ORDERHISTORY WHERE orderId = :orderId");
            $stmt->bindParam(':orderId', $orderId);
            $stmt->execute();
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['status']) && !empty($_POST['status'])){
                $statusId = $_POST['status'];
                if($statusId == 3){
                    // then set then set the shipDate to the current date in the ORDER_TABLE
                    $shipDate = date("Y-m-d");
                    $stmt = $con->prepare("UPDATE ORDER_TABLE SET statusId = :statusId, shipDate = :shipDate WHERE orderId = :orderId");
                    $stmt->bindParam(':statusId', $statusId);
                    $stmt->bindParam(':shipDate', $shipDate);
                    $stmt->bindParam(':orderId', $orderId);
                    $stmt->execute();
                }
                if($statusId == 4){
                    // then set the deliveryDate to the current date in the ORDER_TABLE
                    $deliveryDate = date("Y-m-d");
                    $stmt = $con->prepare("UPDATE ORDER_TABLE SET statusId = :statusId , deliveryDate = :deliveryDate WHERE orderId = :orderId");
                    $stmt->bindParam(':statusId', $statusId);
                    $stmt->bindParam(':deliveryDate', $deliveryDate);
                    $stmt->bindParam(':orderId', $orderId);
                    $stmt->execute();
                }
                else{
                    $stmt = $con->prepare("UPDATE ORDER_TABLE SET statusId = :statusId WHERE orderId = :orderId");
                    $stmt->bindParam(':statusId', $statusId);
                    $stmt->bindParam(':orderId', $orderId);
                    $stmt->execute();
                }
                header('Location: viewAllOrder.php?message=Order Status Updated Successfully.');
                exit();
            }
            else{
                $message = "Order Status is required.<br>";
                include './registration/errormsg.php';
            }
        }
    ?>
    <div class = "form-container">
        <form action="updateOrderStatus.php?orderId= <?php print $orderId?> " method = "post">
            <h2>Update Order Status</h2>
            <div class="input-box">
                <label for="orderId">Order Status</label><br>
                <select name="status">
                    <option value="">Select Status</option>
                    <?php
                    $stmt = $con->prepare("SELECT * FROM STATUS");
                    $stmt->execute();
                    while ($status = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        if ($status['status'] == $order['orderStatus']) {
                            echo '<option value="' . $status['statusId'] . '" selected>' . $status['status'] . '</option>';
                        } else {
                            echo '<option value="' . $status['statusId'] . '">' . $status['status'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="input-box button">
                <!-- Submit button for Update Order Status -->
                <input type="Submit" value="Update">
            </div>
        </form>
    </div>
    <?php require_once 'footerNav.php';?>
</body>
</html>