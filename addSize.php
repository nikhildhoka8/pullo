<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Add Size</title>
</head>
<body>
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php require_once 'adminSecondNav.php';
    require_once 'dbconnect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['size']) && !empty($_POST['size'])) {
            $size = $_POST['size'];
            //check for duplicate size
            $stmt = $con->prepare("SELECT * FROM SIZE WHERE size = ?");
            $stmt->execute([$size]);
            $selectedSize = $stmt->fetch(PDO::FETCH_ASSOC);
            if($selectedSize){
                $message = "Size already exists.<br>";
                include './registration/errormsg.php';
            }
            else{
                $sizeName = htmlspecialchars($_POST['size']);
                $stmt = $con->prepare("INSERT INTO SIZE (size) VALUES (:sizeName)");
                $stmt->bindParam(':sizeName', $sizeName);
                $stmt->execute();
                $message = "Size added successfully.<br>";
                include './registration/successmsg.php';
            }
        }
        else{
            $message = "Size is required.<br>";
            include './registration/errormsg.php';
        }
    }
    
    ?>
    <div class="form-container">
        <form action="addSize.php" method="post">
            <h2>Add Size</h2>
            <div class="input-box">
                <label for="size">Size Name (*REQUIRED)</label><br>
                <input type="text" name="size" value="" ><br>
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