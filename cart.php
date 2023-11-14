<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
if (!isset($_SESSION['userId'])) {
    header('Location: error.php?message=You are not logged in!');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Cart</title>
</head>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
        $('#').DataTable({
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
        <?php require_once 'headerNav.php';
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            include './registration/errormsg.php';
        }
        ?>
    </div>
    <?php
    if (isset($_SESSION['userId'])) {
        if ($_SESSION['userType'] == '1') {
            require_once 'custSecondNav.php';
        } else if ($_SESSION['userType'] == '2') {
            require_once 'adminSecondNav.php';
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            require_once './registration/successmsg.php';
        }
    }
    ?>
    <br>
    <?php
    //check if the user has any items in the cart
    $stmt = $con->prepare("SELECT * FROM VW_CART where userId = :userId");
    $stmt->bindParam(':userId', $_SESSION['userId']);
    $stmt->execute();
    $cartRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$cartRow) {
        header('Location: error.php?message=You have no items in your cart!');
        exit();
    }
    ?>
    <table id="cart">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Description</th>
                <th>Price</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Brand Name</th>
                <th>Category Name</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $con->prepare("SELECT * FROM VW_CART where userId = :userId");
            $stmt->bindParam(':userId', $_SESSION['userId']);
            $stmt->execute();
            while ($cartRow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $cartRow['productName'] . '</td>';
                echo '<td><img src="' . $cartRow['productImageURL'] . '" width="100" height="100"></td>';
                echo '<td>' . $cartRow['productDescription'] . '</td>';
                echo '<td>$' . $cartRow['price'] . '</td>';
                //find the size from the sizeId from the SIZE Table
                $stmt2 = $con->prepare("SELECT size FROM SIZE WHERE sizeId = :sizeId");
                $stmt2->bindParam(':sizeId', $cartRow['sizeId']);
                $stmt2->execute();
                $size = $stmt2->fetch(PDO::FETCH_ASSOC);
                echo '<td>' . $size['size'] . '</td>';
                echo '<td>' . $cartRow['quantity'] . '</td>';
                echo '<td>' . $cartRow['brandName'] . '</td>';
                echo '<td>' . $cartRow['categoryName'] . '</td>';
                echo '<td>' . $cartRow['genderName'] . '</td>';
                echo '<td><a class="btn btn-primary" href="./deleteCart.php?cartId=' . $cartRow['cartId'] . '">Delete</a></td>';
                echo '</tr>';
            }
            //make a row for the total price
            $stmt = $con->prepare("SELECT SUM(price*quantity) as total FROM VW_CART where userId = :userId");
            $stmt->bindParam(':userId', $_SESSION['userId']);
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<tr>';
            echo '<td colspan="3" style="text-align: right;">Total</td>';
            echo '<td>$' . $total['total'] . '</td>';
            echo '</tr>';

            ?>
        </tbody>
    </table>
    <!--add an option to choose the shipping and billing Address-->

    <div class="form-container">


        <form action="checkout.php" method="post">
            <h2>Shipping Details</h2><br>
            <div class="buttons clearfix">
                <div class="pull-left"><a class="btn btn-primary" href="./addAddress.php">Add Address</a>
                </div><br>
            </div>
            <div class="input-box">
                <label for="shippingAdd">Shipping Address (*REQUIRED)</label><br>
                <select name="shippingAdd" required>
                    <option value="">Select Shipping Address</option>
                    <?php
                    $stmtBrand = $con->prepare("SELECT * FROM DELIVERY_ADDRESS WHERE userId = :userId");
                    $stmtBrand->bindParam(':userId', $_SESSION['userId']);
                    $stmtBrand->execute();
                    while ($address = $stmtBrand->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $address['deliveryAddressId'] . "'>" . $address['addressLine1'] . ', ' .  $address['addressLine2'] . ', ' . $address['city'] . "</option>";
                    }
                    ?>
                </select><br>
            </div>
            <div class="input-box">
                <label for="billingAdd">Billing Address (*REQUIRED)</label><br>
                <select name="billingAdd" required>
                    <option value="">Select Billing Address</option>
                    <?php
                    $stmtBrand = $con->prepare("SELECT * FROM DELIVERY_ADDRESS WHERE userId = :userId");
                    $stmtBrand->bindParam(':userId', $_SESSION['userId']);
                    $stmtBrand->execute();
                    while ($address = $stmtBrand->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $address['deliveryAddressId'] . "'>" . $address['addressLine1'] . ', ' .  $address['addressLine2'] . ', ' . $address['city'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input-box">
                <label for="paymentMethod">Payment Method (*REQUIRED)</label><br>
                <select name="paymentMethod" required>
                    <option value="">Select Payment Method</option>
                    <?php
                    $stmt = $con->prepare("SELECT * FROM PAYMENT_METHOD");
                    $stmt->execute();
                    while ($paymentMethod = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $paymentMethod['paymentMethodId'] . "'>" . $paymentMethod['paymentMethod'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input-box button">
                <input type="submit" value="Checkout">
            </div>
        </form>
    </div>

    <?php require_once 'footerNav.php'; ?>
</body>

</html>