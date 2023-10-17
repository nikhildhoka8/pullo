<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Profile</title>
</head>
<body class = "main-layout">
    <div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>

    <?php require_once 'custSecondNav.php';?>

    <div class="form-container">
                <form action="viewUser.php" method="post">
                    <h2>My Account</h2>
                    <label> Hello XYZ!</label>
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
                    <div class="input-box">
                        <label for="newPass">New Password</label><br>
                        <input type="password" name="newPass" value="<?= $selectedUser['newPass'] ?>">
                    </div>
                    <div class="input-box">
                        <label for="confirmNewPass">Confirm New Password</label><br>
                        <input type="password" name="confirmNewPass" value="<?= $selectedUser['confirmNewPass'] ?>">
                    </div>
                    <div class="input-box button">
                        <!-- Submit button for login -->
                        <input type="Submit" value="Update">
                    </div>
                </form>
            </div>
        <?php require_once 'footerNav.php';?>
</body>
</html>
