<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>View Products</title>
</head>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
        $('#products').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ]
        });
    });
</script>

<body class="main-layout">
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php
    require_once 'adminSecondNav.php';
    require_once 'dbconnect.php';
    // create a table to show all the brands in the database
    $stmt = $con->prepare("SELECT * FROM BRAND WHERE activeStatus = TRUE");
    $stmt->execute();
    ?>
    <h2>View Product</h2>
    <div class="buttons clearfix">
        <div class="pull-right"><a class="btn btn-primary" href="./addProduct.php">Add Product</a>
        </div><br><br>
        <table id="products">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Description</th>
                    <th>Brand Name</th>
                    <th>Category Name</th>
                    <th>Price</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $con->prepare("SELECT * FROM VW_PRODUCT WHERE activeStatus = TRUE;");
                $stmt->execute();
                while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $product['productName'] . '</td>';
                    echo '<td><img src="' . $product['productImageURL'] . '" width="100" height="100"></td>';
                    echo '<td>' . $product['productDescription'] . '</td>';
                    echo '<td>' . $product['brand'] . '</td>';
                    echo '<td>' . $product['category'] . '</td>';
                    echo '<td>$' . $product['price'] . '</td>';
                    echo '<td>' . $product['gender'] .  '</td>';
                    echo '<td><a class="btn btn-primary" href="./updateProduct.php?productId=' . $product['productId'] . '">Update</a> <a class="btn btn-primary" href="./deleteProduct.php?productId=' . $product['productId'] . '">Delete</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table><br>



        <?php require_once 'footerNav.php'; ?>
</body>

</html>