<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <?php
    session_start();
    ?>
    <title>Profile</title>
</head>
<body class = "main-layout">
    <div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php
    require_once './registration/util/funcs.php';
    require_once 'dbconnect.php';
    if($_SESSION['userType'] == '1'){
        require_once 'custSecondNav.php';
    }
    if ($_SESSION['userType'] == '2'){
        require_once 'adminSecondNav.php';
    }
    // Initialize variables to store user input
    $stmt = $con->prepare("SELECT * FROM USER_TABLE WHERE userId = ?");
    $stmt->execute([$_SESSION['userId']]);
    $selectedUser = $stmt->fetch(PDO::FETCH_ASSOC);
    $fName = $selectedUser['fName'];
    $lName = $selectedUser['lName'];
    $email = $selectedUser['email'];
    $phoneNumber = $selectedUser['phoneNumber'];
    $dateOfBirth = $selectedUser['dateOfBirth'];
    // Initialize variables to track input validity
    $fNameOK = $lNameOK = $emailOK= $phoneNumberOK = $dateOfBirthOK  = false;
    // Initialize a variable for error messages
    $message = '';

    // Check if the server received a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if user provided values for name, email, and password
        if (isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['email']) && isset($_POST['phoneNumber']) && isset($_POST['dateOfBirth'])) {
            // Check if email and confirm email fields are empty
            if (empty($_POST['email'])) {
                $message =  $message . "Email is required.<br>";
            } else {
                // Validate email format
                $emailOK = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

                // Check if email format is incorrect
                if (!$emailOK) {
                    $message =  $message . "Emails in incorrect format.<br>";
                } else {
                    $email = htmlspecialchars($_POST['email']);
                    $emailOK  = true;
                }
            }

            // Check if the name field is empty
            if (empty($_POST['fName'])) {
                $message =  $message . "First Name is required.<br>";
            } else {
                $fName = htmlspecialchars($_POST['fName']);
                $fNameOK = true;
            }
            if (empty($_POST['lName'])) {
                $message =  $message . "Last Name is required.<br>";
            } else {
                $lName = htmlspecialchars($_POST['lName']);
                $lNameOK = true;
            }
            // Check if the phone number field is empty
            if (empty($_POST['phoneNumber'])) {
                $message =  $message . "Phone number is required.<br>";
            } else {
                $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
                $phoneNumberOK = true;
            }
            // Check if the date of birth field is empty
            if (empty($_POST['dateOfBirth'])) {
                $message =  $message . "Date of birth is required.<br>";
            } else {
                $dateOfBirth = htmlspecialchars($_POST['dateOfBirth']);
                $dateOfBirthOK = true;
            }
        }

        // If there are validation errors, include the error message file
        if (!empty($message)) {
            require_once './registration/errormsg.php';
        }

        // If all inputs are valid, proceed to registration success page
        if ($fNameOK && $lNameOK && $emailOK && $phoneNumberOK && $dateOfBirthOK) {
            $stmt = $con->prepare("UPDATE USER_TABLE SET fName = ?, lName = ?, email = ?, phoneNumber = ?, dateOfBirth = ? WHERE userId = ?");
            $stmt->execute([$fName, $lName, $email, $phoneNumber, $dateOfBirth, $_SESSION['userId']]);
            $message = 'Update Successful';
            require_once './registration/successmsg.php';
        }
    }
    ?>

    <div class="form-container">
                <form action="userProfile.php" method="post">
                    <h2>My Account</h2>
                    <label> Hello <?php echo $selectedUser['fName']. ' '. $selectedUser['lName'] . '!'  ?></label>
                    <div class="input-box">
                        <label for="fName">First Name:</label><br>
                        <input type="text" name="fName" value="<?= $fName ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="lName">Last Name:</label><br>
                        <input type="text" name="lName" value="<?= $lName ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="phoneNumber">Phone Number:</label><br>
                        <input type="tel" name="phoneNumber" value="<?= $phoneNumber ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="email">Email:</label><br>
                        <input type="email" name="email" value="<?= $email ?>"><br>
                    </div>
                    
                    <div class="input-box">
                        <label for="dateOfBirth">Date of Birth:</label><br>
                        <input type="date" name="dateOfBirth" value="<?= $dateOfBirth ?>">
                    </div>
                    <div class="input-box button">
                        <!-- Submit button for login -->
                        <input type="Submit" name="Update" value="Update">
                    </div>
                </form>
            </div>
        <?php require_once 'footerNav.php';?>
</body>
</html>
