<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>User Address</title>
</head>
<?php
    // Dummy data array for addresses
    $addresses = [
        [
            'deliveryAddressId' => 1,
            'userId' => 101,
            'addressLine1' => '123 Main St',
            'addressLine2' => '',
            'addressLine3' => '',
            'city' => 'New York',
            'pincode' => '10001',
            'state' => 'NY',
            'country' => 'USA',
        ],
        [
            'deliveryAddressId' => 2,
            'userId' => 101,
            'addressLine1' => '456 Oak St',
            'addressLine2' => 'Suite 789',
            'addressLine3' => '',
            'city' => 'Los Angeles',
            'pincode' => '90001',
            'state' => 'CA',
            'country' => 'USA',
        ],
        // Add more addresses as needed
    ];
    ?>
<body>
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php require_once 'custSecondNav.php';?>
    <br>
    <div class="buttons clearfix">
            <div class="pull-right"><a class="btn btn-primary" href="./addAddress.php">Add Address</a>
            </div>
        </div>
        <table>
        <thead>
            <tr>
                <th>Address ID</th>
                <th>User ID</th>
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
            foreach ($addresses as $address) {
                echo '<tr>';
                echo '<td>' . $address['deliveryAddressId'] . '</td>';
                echo '<td>' . $address['userId'] . '</td>';
                echo '<td>' . $address['addressLine1'] . '</td>';
                echo '<td>' . $address['addressLine2'] . '</td>';
                echo '<td>' . $address['addressLine3'] . '</td>';
                echo '<td>' . $address['city'] . '</td>';
                echo '<td>' . $address['pincode'] . '</td>';
                echo '<td>' . $address['state'] . '</td>';
                echo '<td>' . $address['country'] . '</td>';
                echo '<td><a href="updateAddress.php?id=' . $address['deliveryAddressId'] . '">Update</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
<br>

    <?php require_once 'footerNav.php';?>
</body>
</html>