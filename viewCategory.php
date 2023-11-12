<?php
session_start();
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Categories</title>
</head>
<script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            $('#categories').DataTable(
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
    // create a table to show all the categories in the database
    $stmt = $con->prepare("SELECT * FROM CATEGORY");
    $stmt->execute();
    ?>
    <h2>Categories</h2>
    <div class="buttons clearfix">
            <div class="pull-right"><a class="btn btn-primary" href="./addCategory.php">Add Category</a>
            </div><br>
    <table id="categories">
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $category['categoryId'] . '</td>';
                echo '<td>' . $category['categoryName'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table><br>
    <?php require_once 'footerNav.php';?>
</body>
</html>