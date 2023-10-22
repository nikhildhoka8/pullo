<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here -->
        <!-- basic -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body class="main-layout">
    <!-- header section start -->
    <div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php require_once 'adminSecondNav.php';?>
    <h1>Admin View User</h1>

    <?php
    // Dummy data array
    $users = [
        [
            'id' => 1,
            'userTypeId' => 1,
            'fName' => 'John',
            'lName' => 'Doe',
            'phoneNumber' => 1001,
            'email' => 'john.doe@example.com',
            'dateOfBirth' => '1990-05-15',
        ],
        [
            'id' => 2,
            'userTypeId' => 2,
            'fName' => 'Jane',
            'lName' => 'Smith',
            'phoneNumber' => 1002,
            'email' => 'jane.smith@example.com',
            'dateOfBirth' => '1985-09-21',
        ],
        [
            'id' => 3,
            'userTypeId' => 1,
            'fName' => 'Bob',
            'lName' => 'Johnson',
            'phoneNumber' => 1003,
            'email' => 'bob.j@example.com',
            'dateOfBirth' => '1978-12-08',
        ],
    ];
    ?>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Type ID</th>
                <th>Name</th>
                <th>Phone No. </th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Update User</th> <!-- New column -->
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) {
                echo '<tr>';
                echo '<td>' . $user['id'] . '</td>';
                echo '<td>' . $user['userTypeId'] . '</td>';
                echo '<td>' . $user['fName'] . ' ' . $user['lName'] . '</td>';
                echo '<td>' . $user['phoneNumber'] . '</td>';
                echo '<td>' . $user['email'] . '</td>';
                echo '<td>' . $user['dateOfBirth'] . '</td>';
                
                // New column with a link to editUser.php
                echo '<td><a href="editCust.php?id=' . $user['id'] . '">Update</a></td>';
                
                echo '</tr>';
            }
            ?>
        </tbody>
    </table><br>

    <?php require_once 'footerNav.php';?>
</body>
</html>
