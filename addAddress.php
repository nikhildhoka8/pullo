<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Add Address</title>
</head>

<body>
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php require_once 'custSecondNav.php'; ?>
    <div class="form-container">
        <form action="addAddress.php" method="post">
            <h2>Add Address</h2>
            <div class="input-box">
                <label for="addLine1">Address Line 1:</label><br>
                <input type="text" name="addLine1" value="" ><br>
            </div>
            <div class="input-box">
                <label for="addLine2">Address Line 2:</label><br>
                <input type="text" name="addLine2" value="" ><br>
            </div>
            <div class="input-box">
                <label for="addLine3">Address Line 3:</label><br>
                <input type="text" name="addLine3" value="" ><br>
            </div>
            <div class="input-box">
                <label for="city">City:</label><br>
                <input type="text" name="city" value="" ><br>
            </div>
            <div class="input-box">
                <label for="pincode">PIN Code:</label><br>
                <input type="number" name="pincode" value="" ><br>
            </div>
            <div class="input-box">
                <label for="state">State:</label><br>
                <input type="text" name="state" value="" ><br>
            </div>
            <div class="input-box">
                <label for="country">Country:</label><br>
                <input type="text" name="country" value="" ><br>
            </div>
            <div class="input-box button">
                <!-- Submit button for login -->
                <input type="Submit" value="Add">
            </div>
        </form>
    </div>
    <?php require_once 'footerNav.php'; ?>
</body>

</html>