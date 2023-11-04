<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Edit Customer</title>
</head>

<body class="main-layout">

    <!-- Header section -->
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php require_once 'adminSecondNav.php';
    require_once 'dbconnect.php';
    ?>

    <?php
    // Check if user ID is set in the URL
    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        $stmt = $con->prepare('SELECT * FROM VW_USER_TYPE WHERE userId = ?');
        $stmt->execute([$userId]);
        $selectedUser = $stmt->fetch(PDO::FETCH_ASSOC);
        $fName = $selectedUser['fName'];
        $lName = $selectedUser['lName'];
        $email = $selectedUser['email'];
        $phoneNumber = $selectedUser['phoneNumber'];
        $dateOfBirth = $selectedUser['dateOfBirth'];
        $userType = $selectedUser['userType'];
        //Display the form for editing user details
        $fNameOK = $lNameOK = $emailOK = $phoneNumberOK = $dateOfBirthOK = $userTypeOK = false;
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['fName'])) {
                $fName = htmlspecialchars($_POST['fName']);
                $fNameOK = true;
            }
            else{
                $message .= 'First Name is required.<br>';
            }
            if (isset($_POST['lName'])) {
                $lName = htmlspecialchars($_POST['lName']);
                $lNameOK = true;
            }
            else{
                $message .= 'Last Name is required.<br>';
            }
            if (isset($_POST['email'])) {
                $email = htmlspecialchars($_POST['email']);
                $emailOK = true;
            }
            else{
                $message .= 'Email is required.<br>';
            }
            if (isset($_POST['phoneNumber'])) {
                $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
                $phoneNumberOK = true;
            }
            else{
                $message .= 'Phone Number is required.<br>';
            }
            if (isset($_POST['dateOfBirth'])) {
                $dateOfBirth = htmlspecialchars($_POST['dateOfBirth']);
                $dateOfBirthOK = true;
            }
            else{
                $message .= 'Date of Birth is required.<br>';
            }
            if (isset($_POST['userType']) && $_POST['userType'] != 0) {
                $userType = htmlspecialchars($_POST['userType']);
                $userTypeOK = true;
            }
            else{
                $message .= 'User Type is required.<br>';
            }
            if ($fNameOK && $lNameOK && $emailOK && $phoneNumberOK && $dateOfBirthOK && $userTypeOK) {
                $stmt = $con->prepare('UPDATE USER_TABLE SET fName = ?, lName = ?, email = ?, phoneNumber = ?, dateOfBirth = ?, userTypeId = ? WHERE userId = ?');
                $stmt->execute([$fName, $lName, $email, $phoneNumber, $dateOfBirth, $userType, $userId]);
            }
            else{
                include './registration/errormsg.php';
            }
        }
        if ($selectedUser) {
    ?>
            <div class="form-container">
                <form action="editCust.php?userId= <?php print $selectedUser['userId'] ?>" method="post">
                    <h2>Edit User</h2>
                    <input type="hidden" name="userId" value="<?= $selectedUser['userId'] ?>">

                    <div class="input-box">
                        <label for="fName">First Name: (*REQUIRED)</label><br>
                        <input type="text" name="fName" value="<?= $fName ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="lName">Last Name: (*REQUIRED)</label><br>
                        <input type="text" name="lName" value="<?= $lName ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="phoneNumber">Phone Number: (*REQUIRED)</label><br>
                        <input type="tel" name="phoneNumber" value="<?= $phoneNumber ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="email">Email: (*REQUIRED)</label><br>
                        <input type="email" name="email" value="<?= $email ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="dateOfBirth">Date of Birth: (*REQUIRED)</label><br>
                        <input type="date" name="dateOfBirth" value="<?= $dateOfBirth ?>">
                    </div>
                    <div>
                        <label for="userType">User Type: (*REQUIRED)</label><br>
                        <select name="userType">
                        <option value="0">Select User Type</option>
                            <?php
                            $stmt2= $con->prepare('SELECT * FROM USER_TYPE');
                            $stmt2->execute();
                            
                            while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                //make the current user type to be default
                                $selected = ($row['userType'] == $userType) ? 'selected' : '';
                                
                                echo '<option value="' . $row['userTypeId'] . '" ' . $selected . '>' . $row['userType'] . '</option>';
                            }
                            ?>
                        </select>
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