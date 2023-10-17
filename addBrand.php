<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Add Brand</title>
</head>
<body>
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php require_once 'adminSecondNav.php';?>
    <div class="form-container">
        <form action="addBrand.php" method="post">
            <h2>Add Brand</h2>
            <div class="input-box">
                <label for="brandName">Brand Name</label><br>
                <input type="text" name="brandName" value="" ><br>
            </div>
            <div class="input-box button">
                <!-- Submit button for login -->
                <input type="Submit" value="Add">
            </div>
        </form>
    </div>
    <?php require_once 'footerNav.php';?>
</body>
</html>