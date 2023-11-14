<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>View Stock</title>
</head>
<script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            $('#stock').DataTable(
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
        require_once 'dbconnect.php';
    ?>
    <div class="buttons clearfix">
            <br><div class="pull-right"><a class="btn btn-primary" href="./addStock.php">Add Stock</a>
            </div><br><br>
    <table id="stock">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Brand Name</th>
                <th>Category Name</th>
                <th>Size</th>
                <th>Gender</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $con->prepare("SELECT * FROM VW_STOCK where activeStatus = TRUE");
            $stmt->execute();
            while ($stock = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $stock['productName'] . '</td>';
                echo '<td><img src="' . $stock['productImageURL'] . '" width="100" height="100"></td>';
                echo '<td>' . $stock['brand'] . '</td>';
                echo '<td>' . $stock['category'] . '</td>';
                echo '<td>' . $stock['size'] . '</td>';
                echo '<td>' . $stock['gender'] . '</td>';
                echo '<td>' . $stock['stockQuantity'] . '</td>';
                echo '<td>$' . $stock['price'] . '</td>';
                echo '<td><a class="btn btn-primary" href="./updateStock.php?stockId=' . $stock['stockId'] . '">Update</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table><br>
    
    <?php require_once 'footerNav.php';?>
</body>
</html>