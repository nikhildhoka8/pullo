<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Display Last Name</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
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
</head>

<body class="main-layout">
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php
    if (isset($_SESSION['user'])) {
        if ($_SESSION['userType'] == '1') {
            require_once 'custSecondNav.php';
        } else if ($_SESSION['userType'] == '2') {
            require_once 'adminSecondNav.php';
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['lName']) && !empty($_POST['lName'])) {
        $lName = htmlspecialchars($_POST['lName']);
        $stmt = $con->prepare("SELECT * FROM VW_USER_TYPE WHERE lName = ?");
        $stmt->execute([$lName]);
        if($stmt->rowCount() == 0){
            print "<br><h2>No users found with that LAST NAME</h2> ";
        }
        else{
    ?>
            <br><table id="users" class="display">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Type</th>
                        <th>Name</th>
                        <th>Phone No. </th>
                        <th>Email</th>
                        <th>Date of Birth</th>
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
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table><br>
    <?php
        }
    } else {
        print "Access Denied";
    }
    ?>

    <?php require_once 'footerNav.php'; ?>
</body>

</html>