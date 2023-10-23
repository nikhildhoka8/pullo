<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>View Size</title>
</head>

<body>
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php require_once 'adminSecondNav.php';
    require_once 'dbconnect.php';
    // create a table to show all the sizes in the database
    $stmt = $con->prepare("SELECT * FROM SIZE");
    $stmt->execute();
    ?>
    <br><div class="buttons clearfix">
        <div class="pull-right"><a class="btn btn-primary" href="./addSize.php">Add Size</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Size ID</th>
                <th>Size Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($size = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $size['sizeId'] . '</td>';
                echo '<td>' . $size['size'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <?php require_once 'footerNav.php'; ?>
</body>

</html>