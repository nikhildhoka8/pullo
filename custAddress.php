<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>User Address</title>
</head>
<body>
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            $('#address').DataTable(
                {
            searching: true,
            ordering: true,
            paging: true,
            lengthMenu: [ [10, 20, 50, -1], [10, 20, 50, "All"] ]
        }
            );

        });
    </script>
    <?php 
    require_once 'custSecondNav.php';
    require_once 'dbconnect.php';
    // create a table to show all the addresses in the database
    if(isset($_GET['message'])){
        $message = $_GET['message'];
        include './registration/successmsg.php';
    }
    $stmt = $con->prepare("SELECT * FROM VW_USER_DELIVERY_ADDRESS WHERE userId = ? and activeStatus = TRUE");
    $stmt->execute([$_SESSION['userId']]);
    ?>
    <br>
    <div class="buttons clearfix">
            <div class="pull-right"><a class="btn btn-primary" href="./addAddress.php">Add Address</a>
            </div><br>
        </div>
        <table id = "address">
        <thead>
            <tr>
                <th>Number</th>
                <th>Address Line 1</th>
                <th>Address Line 2</th>
                <th>Address Line 3</th>
                <th>City</th>
                <th>PIN Code</th>
                <th>State</th>
                <th>Country</th>
                <th class="update-column">Update</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $row['addressLine1'] . '</td>';
                echo '<td>' . $row['addressLine2'] . '</td>';
                echo '<td>' . $row['addressLine3'] . '</td>';
                echo '<td>' . $row['city'] . '</td>';
                echo '<td>' . $row['pincode'] . '</td>';
                echo '<td>' . $row['state'] . '</td>';
                echo '<td>' . $row['countryName'] . '</td>';
                //Update and Delete buttons
                echo '<td><a class="btn btn-primary" href="./updateAddress.php?deliveryAddressId=' . $row['deliveryAddressId'] . '">Update</a> <a class="btn btn-primary" href ="./deleteAddress.php?deliveryAddressId=' . $row['deliveryAddressId'] . '">Delete </a></td>';
                echo '</tr>';
                $i++;
            }
            ?>
        </tbody>
    </table>
<br>

    <?php require_once 'footerNav.php';?>
</body>
</html>