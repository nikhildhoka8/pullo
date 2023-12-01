<?php
session_start();
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php';?>
    <title>View Order Details
    </title>
</head>

<body class="main-layout">
    <!-- header section start -->
    <div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>

    <div class="container">
        <br>
        <h2 class="title">Order Details</h2>
        <div class="buttons clearfix">
            <div class="pull-right"><a class="btn btn-primary" href="./orderHistory.php">Back</a>
            </div>
        </div>
        <?php
        require_once 'dbconnect.php';
        if(isset($_GET['orderId'])){
            $orderId = $_GET['orderId'];
        }
        else{
            header('Location: error.php?message=Invalid Access');
            exit();
        }
        $stmt = $con->prepare("SELECT * FROM VW_ORDERHISTORY WHERE orderId = :orderId");
        $stmt->bindParam(':orderId', $_GET['orderId']);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td colspan="2" class="text-left">Order Details</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 50%;" class="text-left"> <b>Order ID:</b> #<?php echo $order['orderId']; ?>
                        <br>
                        <b>Date Added:</b> <?php echo $order['orderDate']; ?>
                    </td>
                    <?php
                    $stmt = $con->prepare("SELECT paymentMethod FROM PAYMENT_METHOD WHERE paymentMethodId = :paymentMethodId");
                    $stmt->bindParam(':paymentMethodId', $order['paymentMethodId']);
                    $stmt->execute();
                    $paymentMethod = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <td style="width: 50%;" class="text-left"> <b>Payment Method:</b> <?php echo $paymentMethod['paymentMethod']; ?>
                        <br>
                        <b>Shipping Method:</b> Flat Shipping Rate
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td style="width: 50%; vertical-align: top;" class="text-left">Payment Address</td>
                    <td style="width: 50%; vertical-align: top;" class="text-left">Shipping Address</td>
                </tr>
            </thead>
            <?php
            //get the user from the userId on the order
            $stmt = $con->prepare("SELECT * FROM USER_TABLE WHERE userId = :userId");
            $stmt->bindParam(':userId', $order['userId']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <tbody>
                <tr>
                    <td class="text-left"><?php echo $user['fName'] . ' ' . $user['lName']; ?>
                    <?php
                    // get the billing Address from the Billing address Id on the order
                    $stmt = $con->prepare("SELECT * FROM VW_USER_DELIVERY_ADDRESS WHERE deliveryAddressId = :addressId");
                    $stmt->bindParam(':addressId', $order['billingAddressId']);
                    $stmt->execute();
                    $billingAddress = $stmt->fetch(PDO::FETCH_ASSOC);

                    ?>
                        <br><?php echo $billingAddress['addressLine1']; ?>
                        <br><?php echo $billingAddress['addressLine2']; ?>
                        <?php
                        if(!empty($billingAddress['addressLine3'])){
                            echo '<br>' . $billingAddress['addressLine3'];
                        }
                        ?>
                        <br><?php echo $billingAddress['city']; ?>
                        <br><?php echo $billingAddress['state'] . ' - ' . $billingAddress['pincode']; ?>
                        <br><?php echo $billingAddress['countryName']; ?>
                    </td>
                    <td class="text-left"><?php echo $user['fName'] . ' ' . $user['lName']; ?>
                    <?php
                    // get the shipping Address from the Shipping address Id on the order
                    $stmt = $con->prepare("SELECT * FROM VW_USER_DELIVERY_ADDRESS WHERE deliveryAddressId = :addressId");
                    $stmt->bindParam(':addressId', $order['deliveryAddressId']);
                    $stmt->execute();
                    $shippingAddress = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                        <br><?php echo $shippingAddress['addressLine1']; ?>
                        <br><?php echo $shippingAddress['addressLine2']; ?>
                        <?php
                        if(!empty($shippingAddress['addressLine3'])){
                            echo '<br>' . $shippingAddress['addressLine3'];
                        }
                        ?>
                        <br><?php echo $shippingAddress['city']; ?>
                        <br><?php echo $shippingAddress['state'] . ' - ' . $shippingAddress['pincode']; ?>
                        <br><?php echo $shippingAddress['countryName']; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-left">Product Name</td>
                        <td class="text-left">Product Image</td>
                        <td class="text-right">Quantity</td>
                        <td class="text-left">Brand</td>
                        <td class="text-left">Category</td>
                        <td class="text-left">Size</td>
                        <td class="text-left">Gender</td>
                        <td class="text-right">Price</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left"><?php print $order['productName'] ?> </td>
                        <td class="text-left"><img src="<?php print $order['productImageURL'] ?>" height = "50px" width="50px"></td>
                        <td class="text-right"><?php print $order['quantity'] ?></td>
                        <td class="text-left"><?php print $order['brandName'] ?></td>
                        <td class="text-left"><?php print $order['categoryName'] ?></td>
                        <td class="text-left"><?php print $order['size'] ?></td>
                        <td class="text-left"><?php print $order['genderName'] ?></td>
                        <td class="text-right"><?php print '$' . $order['price'] ?></td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6"></td>
                        <td class="text-right"><b>Total</b>
                        </td>
                        <td class="text-right"><?php print '$' . $order['price'] ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <h3>Order History</h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td class="text-left">Date Added</td>
                    <td class="text-left">Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($order['deliveryDate'])){
                    echo '<tr>';
                    echo '<td class="text-left">' . $order['deliveryDate'] . '</td>';
                    echo '<td class="text-left">Delivered</td>';
                    echo '</tr>';
                }
                if(isset($order['shipDate'])){
                    echo '<tr>';
                    echo '<td class="text-left">' . $order['shipDate'] . '</td>';
                    echo '<td class="text-left">Shipped</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <td class="text-left"><?php print$order['orderDate'] ?></td>
                    <td class="text-left">Received</td>
                </tr>
            </tbody>
        </table>
        <div class="buttons clearfix">
            <div class="pull-right"><a class="btn btn-primary" href="./orderHistory.php">Back</a>
            </div>
        </div>
    </div><br>
    <?php require_once 'footerNav.php';?>

</body>

</html>