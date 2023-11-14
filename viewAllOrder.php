<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Order History</title>
</head>
<script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            $('#orderHistory').DataTable(
                {
            searching: true,
            ordering: true,
            paging: true,
            lengthMenu: [ [10, 20, 50, -1], [10, 20, 50, "All"] ]
        }
            );

        });
    </script>
<body class="main-layout">
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php
    require_once 'adminSecondNav.php';
    if(isset($_GET['message'])){
        $message = $_GET['message'];
        require_once './registration/successmsg.php';
    }
    ?>
    <table id="orderHistory">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $con->prepare("SELECT * FROM VW_ORDERHISTORY");
            $stmt->execute();
            while ($order = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                //find the Customer Name by using the userId from the VW_ORDERHISTORY
                $stmt2 = $con->prepare("SELECT * FROM USER_TABLE where userId = :userId");
                $stmt2->bindParam(':userId', $order['userId']);
                $stmt2->execute();
                $user = $stmt2->fetch(PDO::FETCH_ASSOC);
                echo '<td>' . $user['fName'] . ' ' . $user['lName'] . '</td>';
                echo '<td>' . $order['productName'] . '</td>';
                echo '<td><img src="' . $order['productImageURL'] . '" width="100" height="100"></td>';
                echo '<td>' . $order['size'] . '</td>';
                echo '<td>' . $order['quantity'] . '</td>';
                echo '<td>' . $order['price'] . '</td>';
                echo '<td>' . $order['orderStatus'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <?php require_once 'footerNav.php';?>
</body>
</html>