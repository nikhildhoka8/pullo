<?php
session_start();
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>View Brand</title>
</head>
<script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            $('#brands').DataTable(
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
        <?php require_once 'headerNav.php';
        ?>
    </div>
    <?php
    require_once 'adminSecondNav.php';
    require_once 'dbconnect.php';
    // create a table to show all the brands in the database
    $stmt = $con->prepare("SELECT * FROM BRAND");
    $stmt->execute();
    ?>
    <h2>View Brand</h2>
    <div class="buttons clearfix">
            <div class="pull-right"><a class="btn btn-primary" href="./addBrand.php">Add Brand</a>
            </div><br>
    <table id="brands">
        <thead>
            <tr>
                <th>Brand ID</th>
                <th>Brand Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($brand = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $brand['brandId'] . '</td>';
                echo '<td>' . $brand['brandName'] . '</td>';                               
                echo '</tr>';
            }
            ?>
        </tbody>
    </table><br>

    <?php require_once 'footerNav.php';?>
</body>
</html>