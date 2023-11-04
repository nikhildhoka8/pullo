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

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td colspan="2" class="text-left">Order Details</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 50%;" class="text-left"> <b>Order ID:</b> #214521
                        <br>
                        <b>Date Added:</b> 20/06/2016
                    </td>
                    <td style="width: 50%;" class="text-left"> <b>Payment Method:</b> Cash On Delivery
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
            <tbody>
                <tr>
                    <td class="text-left">Jhone Cary
                        <br>Central Square
                        <br>22 Hoi Wing Road
                        <br>New Delhi
                        <br>India
                    </td>
                    <td class="text-left">Jhone Cary
                        <br>Central Square
                        <br>22 Hoi Wing Road
                        <br>New Delhi
                        <br>India
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-left">Product Name</td>
                        <td class="text-left">Model</td>
                        <td class="text-right">Quantity</td>
                        <td class="text-right">Price</td>
                        <td class="text-right">Total</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">iPhone5 </td>
                        <td class="text-left">product 11</td>
                        <td class="text-right">1</td>
                        <td class="text-right">$123.20</td>
                        <td class="text-right">$123.20</td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Sub-Total</b>
                        </td>
                        <td class="text-right">$101.00</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Flat Shipping Rate</b>
                        </td>
                        <td class="text-right">$5.00</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Eco Tax (-2.00)</b>
                        </td>
                        <td class="text-right">$6.00</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>VAT (20%)</b>
                        </td>
                        <td class="text-right">$21.20</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Total</b>
                        </td>
                        <td class="text-right">$133.20</td>
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
                <tr>
                    <td class="text-left">20/06/2016</td>
                    <td class="text-left">Processing</td>
                </tr>
                <tr>
                    <td class="text-left">21/06/2016</td>
                    <td class="text-left">Shipped</td>
                </tr>
                <tr>
                    <td class="text-left">24/06/2016</td>
                    <td class="text-left">Complete</td>
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