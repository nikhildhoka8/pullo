<?php
session_start();
?>
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
    <?php require_once 'custSecondNav.php'; 
    require_once 'dbconnect.php';
    $addressLine1 = $addressLine2 = $addressLine3 = $city = $pincode = $state = $country = "";
    $addressLine1OK = $cityOK = $pincodeOK = $stateOK = $countryOK = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //check user input before entering into database. All fields are required
        if (isset($_POST['addressLine1']) && !empty($_POST['addressLine1'])) {
            $addressLine1 = htmlspecialchars($_POST['addressLine1']);
            $addressLine1OK = true;
        }
        else{
            $message = "Address Line 1 is required.<br>";
            include './registration/errormsg.php';
        }
        if (isset($_POST['city']) && !empty($_POST['city'])) {
            $city = htmlspecialchars($_POST['city']);
            $cityOK = true;
        }
        else{
            $message = "City is required.<br>";
            include './registration/errormsg.php';
        }
        if (isset($_POST['pincode']) && !empty($_POST['pincode'])) {
            $pincode = htmlspecialchars($_POST['pincode']);
            $pincodeOK = true;
        }
        else{
            $message = "PIN Code is required.<br>";
            include './registration/errormsg.php';
        }
        if (isset($_POST['state']) && !empty($_POST['state'])) {
            $state = htmlspecialchars($_POST['state']);
            $stateOK = true;
        }
        else{
            $message = "State is required.<br>";
            include './registration/errormsg.php';
        }
        if (isset($_POST['country']) && !empty($_POST['country'])) {
            $country = htmlspecialchars($_POST['country']);
            $countryOK = true;
        }
        else{
            $message = "Country is required.<br>";
            include './registration/errormsg.php';
        }
        $addressLine2 = htmlspecialchars($_POST['addressLine2']);
        $addressLine3 = htmlspecialchars($_POST['addressLine3']);
        
        if($addressLine1OK && $cityOK && $pincodeOK && $stateOK && $countryOK){
            $stmt = $con->prepare("INSERT INTO DELIVERY_ADDRESS (addressLine1, addressLine2, addressLine3, city, pinCode, state, countryId, userId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$addressLine1, $addressLine2, $addressLine3, $city, $pincode, $state, $country, $_SESSION['userId']]);
            header('Location: custAddress.php?message=Address added successfully.');
        }
    }
    ?>
    <div class="form-container">
        <form action="addAddress.php" method="post">
            <h2>Add Address</h2>
            <div class="input-box">
                <label for="addLine1">Address Line 1: (*REQUIRED)</label><br>
                <input type="text" name="addressLine1" value="<?php print $addressLine1 ?>" ><br>
            </div>
            <div class="input-box">
                <label for="addLine2">Address Line 2: (*REQUIRED)</label><br>
                <input type="text" name="addressLine2" value="<?php print $addressLine2 ?>" ><br>
            </div>
            <div class="input-box">
                <label for="addLine3">Address Line 3: (*REQUIRED)</label><br>
                <input type="text" name="addressLine3" value="<?php print $addressLine3 ?>" ><br>
            </div>
            <div class="input-box">
                <label for="city">City: (*REQUIRED)</label><br>
                <input type="text" name="city" value="<?php print $city ?>" ><br>
            </div>
            <div class="input-box">
                <label for="pincode">PIN Code: (*REQUIRED)</label><br>
                <input type="number" name="pincode" value="<?php print $pincode ?>" ><br>
            </div>
            <div class="input-box">
                <label for="state">State: (*REQUIRED)</label><br>
                <input type="text" name="state" value="<?php print $state ?>" ><br>
            </div>
            <div class="input-box">
                <label for="country">Country: (*REQUIRED)</label><br>
                <select name ="country">
                    <?php
                    $stmt2 = $con->prepare("SELECT * FROM COUNTRY");
                    $stmt2->execute();
                    ?>
                    <option value="">Select Country</option>
                    <?php
                    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        if($row['countryId'] == $country){
                            echo '<option value="' . $row['countryId'] . '" selected>' . $row['country'] . '</option>';
                        }
                        else{
                            echo '<option value="' . $row['countryId'] . '">' . $row['country'] . '</option>';
                        }
                    }
                    ?>
                </select>
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