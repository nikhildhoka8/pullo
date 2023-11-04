<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>
        Order History
    </title>
</head>
<body class="main-layout">
	<!-- header section start -->
	<div class=" header_main">
		<?php require_once 'headerNav.php';?>
	</div>
    <?php require_once 'custSecondNav.php';?>
    <?php
$orderHistory = array(
    array('id' => 1, 'name' => 'Yeezy Boost 350 V2', 'image' => './images/air-jordan-1-dior.png', 'qty' => 2, 'status' => 'Shipped', 'total' => '$300.00'),
    array('id' => 2, 'name' => 'Air Jordan 1 Retro High', 'image' => 'jordan1.jpg', 'qty' => 1, 'status' => 'Delivered', 'total' => '$150.00'),
    // Add more dummy data as needed
);
?>
    <h1>Order History</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Prodct Name </th>
                <th>Image</th>
                <th>Qty</th>
                <th>Status</th> 
                <th>Total</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($orderHistory as $order) {
                echo '<tr>';
                echo '<td>' . $order['id'] . '</td>';
                echo '<td>' . $order['name'] . '</td>';
                echo '<td><img src="' . $order['image'] . '" alt="Product Image" style="width: 100px; height: auto;"></td>';
                echo '<td>' . $order['qty'] . '</td>';
                echo '<td>' . $order['status'] . '</td>';
                echo '<td>' . $order['total'] . '</td>';
                echo '<td><a href="viewOrderDetail.php?id=' . $order['id'] . '" class="view-button"><span class="eye-icon">&#128065;</span> View</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table><br>


<?php require_once 'footerNav.php';?>
</body>
</html>