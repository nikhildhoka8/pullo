<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
</head>

<body class="main-layout">
    <!-- header section start -->
    <div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php require_once 'adminSecondNav.php';
    require_once 'dbconnect.php';
    ?>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
            $('#users').DataTable(
                {
            searching: true,
            ordering: true,
            paging: true,
            lengthMenu: [ [10, 20, 50, -1], [10, 20, 50, "All"] ]
        }
            );

        });
    </script>
    <h1>Admin View User</h1>

    <?php
    // Dummy data array
    $stmt = $con->prepare('SELECT * FROM VW_USER_TYPE WHERE activeStatus = TRUE');
    $stmt->execute();
    ?>

    <table id="users">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Type</th>
                <th>Name</th>
                <th>Phone No. </th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Update User</th> <!-- New column -->
            </tr>
        </thead>
        <tbody>
            <?php
            while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $user['userId'] . '</td>';
                echo '<td>' . $user['userType'] . '</td>';
                echo '<td>' . $user['fName'] . ' ' . $user['lName'] . '</td>';
                echo '<td>' . $user['phoneNumber'] . '</td>';
                echo '<td>' . $user['email'] . '</td>';
                echo '<td>' . $user['dateOfBirth'] . '</td>';
                
                // New column with a link to editUser.php
                echo '<td><a class="btn btn-primary" href="editCust.php?userId=' . $user['userId'] . '">Update</a> <a class="btn btn-primary" href="deleteCust.php?userId='. $user['userId'] .'">Delete</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table><br>

    <?php require_once 'footerNav.php';?>
</body>
</html>
