<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your head content here -->
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Edit User</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
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

    <!-- Header section -->
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php require_once 'adminSecondNav.php';?>

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
        // Add more dummy data as needed
    ];

    // Check if user ID is set in the URL
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

        // Find the user with the specified user ID
        $selectedUser = null;
        foreach ($users as $user) {
            if ($user['id'] == $userId) {
                $selectedUser = $user;
                break;
            }
        }

        // Display the form for editing user details
        if ($selectedUser) {
    ?>
            <div class="form-container">
                <form action="viewCust.php" method="post">
                    <h2>Edit User</h2>
                    <input type="hidden" name="userId" value="<?= $selectedUser['id'] ?>">

                    <div class="input-box">
                        <label for="firstName">First Name:</label><br>
                        <input type="text" name="firstName" value="<?= $selectedUser['fName'] ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="lastName">Last Name:</label><br>
                        <input type="text" name="lastName" value="<?= $selectedUser['lName'] ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="phoneNumber">Phone Number:</label><br>
                        <input type="tel" name="phoneNumber" value="<?= $selectedUser['phoneNumber'] ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="email">Email:</label><br>
                        <input type="email" name="email" value="<?= $selectedUser['email'] ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="dateOfBirth">Date of Birth:</label><br>
                        <input type="date" name="dateOfBirth" value="<?= $selectedUser['dateOfBirth'] ?>">
                    </div>
                    <div class="input-box button">
                        <!-- Submit button for login -->
                        <input type="Submit" value="Update">
                    </div>
                </form>
            </div>
    <?php
        } else {
            echo '<p>User not found.</p>';
        }
    } else {
        echo '<p>No user ID specified.</p>';
    }
    ?>

    <?php require_once 'footerNav.php'; ?>
</body>

</html>