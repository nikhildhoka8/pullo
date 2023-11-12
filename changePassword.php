<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Profile</title>
</head>
<body class="main-layout">
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php
    if(isset($_SESSION['userId'])){
        if($_SESSION['userType'] == '1'){
            require_once 'custSecondNav.php';
        }else if($_SESSION['userType'] == '2'){
            require_once 'adminSecondNav.php';
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $message = "";
        $oldPassword = $newPassword = $confirmNewPassword = "";
        $oldPasswordOK = $newPasswordOK = $confirmNewPasswordOK = false;
        if(isset($_POST['oldPassword']) && !empty($_POST['oldPassword'])){
            $oldPassword = htmlspecialchars($_POST['oldPassword']);
        }
        else{
            $message .= "Old Password is required.<br>";
        }
        if(isset($_POST['newPassword']) && !empty($_POST['newPassword'])){
            $newPassword = htmlspecialchars($_POST['newPassword']);
        }
        else{
            $message .= "New Password is required.<br>";
        }
        if(isset($_POST['confirmNewPassword']) && !empty($_POST['confirmNewPassword'])){
            $confirmNewPassword = htmlspecialchars($_POST['confirmNewPassword']);
        }
        else{
            $message .= "Confirm New Password is required.<br>";
        }
        $stmt = $con->prepare("SELECT * FROM USER_TABLE WHERE userId = ?");
        $stmt->execute([$_SESSION['userId']]);
        $selectedUser = $stmt->fetch(PDO::FETCH_ASSOC);
        if($oldPassword == $selectedUser['password']){
            $oldPasswordOK = true;
        }
        else{
            $message .= "Old Password is incorrect.<br>";
        }
        if(checkPass($newPassword) == false){
            $message .= "New Password must contain at least 10 characters and must contain both letters and digits.<br>";
        }
        if($newPassword == $confirmNewPassword){
            $newPasswordOK = true;
            $confirmNewPasswordOK = true;
        }
        else{
            $message .= "New Password and Confirm New Password do not match.<br>";
        }
        if (!empty($message)) {
            include('./registration/errormsg.php');
        }
        else{
            $stmt = $con->prepare("UPDATE USER_TABLE SET password = ? WHERE userId = ?");
            $stmt->execute([$newPassword, $_SESSION['userId']]);
            $message = "Password changed successfully.";
            include('./registration/successmsg.php');
        }
    }
    ?>
    <div class = "form-container">
        <form action="changePassword.php" method= "POST">
            <h2>Change Password</h2>
            <div class="input-box">
                <label for="oldPassword">Old Password</label>
                <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter Old Password">
            </div>
            <div class="input-box">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password">
            </div>
            <div class="input-box">
                <label for="confirmNewPassword">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password">
            </div>
            <div class= "input-box button">
                <input type="submit" value="Change Password">
            </div>
        </form>
    </div>
    <?php require_once 'footerNav.php';?>
</body>
</html>