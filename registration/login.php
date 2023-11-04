<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- HTML Head Template -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the title of the webpage -->
    <title>User Login</title>
    <!-- Include external CSS stylesheets -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/rivet-core@2.5.2/css/rivet.min.css">
    <script src="https://unpkg.com/rivet-core@2.5.2/js/rivet.min.js"></script>
    <script>
        Rivet.init();
    </script>
</head>

<body>
    <?php
    require_once 'util/funcs.php';
    require_once '../dbconnect.php';
    // Initialize variables to store user input
    $email = $password = '';
    // Initialize variables to track input validity
    $emailOK = $passwordOK = false;
    // Initialize a variable for error messages
    $message = '';
    if(!empty($_GET['activation_code'])){
        $activation_code = $_GET['activation_code'];
        if(checkActivationCode($activation_code) == true){
            $message = 'Registration Successful';
            include "successmsg.php";
        }
    }
    if (isset($_POST['email']) && isset($_POST['password'])){
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $message =  $message . "Email and password are required.<br>";
        }
        else{
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
        }
        
        $emailOK = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if (!$emailOK){
            $message =  $message . "Email in incorrect format.<br>";
        }
        else{
            $emailOK = true;
        }
        if(checkPass($password) == false){
            $message =  $message . "Password must contain at least 10 characters and must contain both letters and digits.<br>";
            $passwordOK = false;
        }
        else{
            $passwordOK = true;
        }
        if($emailOK && $passwordOK){
            session_start();
            $stmt = $con->prepare("SELECT * FROM USER_TABLE WHERE email = ? and password = ?");
            $stmt->execute([$email, $password]);
            if($stmt->rowCount() == 0){
                $message = 'Credentials do not match';
                include "errormsg.php";
            }
            else{
                $row = $stmt->fetch(PDO::FETCH_OBJ);
                $userId = $row->userId;
                $userType= $row->userTypeId;
                $_SESSION['userId'] = $userId;
                $_SESSION['userType'] = $userType;
                $message = 'Login Successful';
                include "successmsg.php";
                Header("Location: ../index.php");
            }
            
        }
        else{
            $message = 'Login Failed';
            include "errormsg.php";
        }
    }
    
    ?>
    <div class="wrapper">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <div class="input-box">
                <!-- Input field for user's email -->
                <input type="email" name="email" placeholder="Enter your email (*REQUIRED)" value="<?php print $email ?>">
            </div>
            <div class="input-box">
                <!-- Input field for user's password -->
                <input type="password" name="password" placeholder="Enter your password (*REQUIRED)">
            </div>
            <div class="input-box button">
                <!-- Submit button for login -->
                <input type="Submit" value="Login">
            </div>
        </form>
    </div>
</body>

</html>
