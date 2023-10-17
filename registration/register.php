<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- HTML Head Template -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the title of the webpage -->
    <title> User Registration </title>
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
    include 'util/funcs.php';
    // Initialize variables to store user input
    $fName = $lName = $email = $confirmEmail = $password = $confirmPassword = $phone = $dob = '';
    // Initialize variables to track input validity
    $fNameOK = $lNameOK = $emailOK = $confirmEmailOK = $passwordOK = $confirmPasswordOK = $phoneOK = $dobOK = $TandC = false;
    // Initialize a variable for error messages
    $message = '';

    // Check if the server received a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if user provided values for name, email, and password
        if (isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['email']) && isset($_POST['confirm_email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['phone']) && isset($_POST['dob'])) {

            // Check if email and confirm email fields are empty
            if (empty($_POST['email']) || empty($_POST['confirm_email'])) {
                $message =  $message . "Emails are required.<br>";
            } else {
                // Validate email format
                $emailOK = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $confirm_emailOK = filter_input(INPUT_POST, 'confirm_email', FILTER_VALIDATE_EMAIL);

                // Check if email format is incorrect
                if (!$emailOK || !$confirm_emailOK) {
                    $message =  $message . "Emails in incorrect format.<br>";
                } else {
                    $email = htmlspecialchars($_POST['email']);
                    $confirmEmail = htmlspecialchars($_POST['confirm_email']);

                    // Check if the email addresses match
                    if ($email !== $confirmEmail) {
                        $message =  $message . "Emails do not match.<br>";
                        $emailOK = $confirm_emailOK = false;
                    } else {
                        $emailOK = $confirm_emailOK = true;
                    }
                }
            }

            // Check if the name field is empty
            if (empty($_POST['fName'])) {
                $message =  $message . "First Name is required.<br>";
            } else {
                $name = htmlspecialchars($_POST['fName']);
                $fNameOK = true;
            }
            if (empty($_POST['lName'])) {
                $message =  $message . "Last Name is required.<br>";
            } else {
                $name = htmlspecialchars($_POST['lName']);
                $lNameOK = true;
            }
            // Check if password and confirm password fields are empty
            if (empty($_POST['password']) || empty($_POST['confirm_password'])) {
                $message =  $message . "Passwords are required.<br>";
            } else {
                $password = htmlspecialchars($_POST['password']);
                $confirmPassword = htmlspecialchars($_POST['confirm_password']);
                //enforce password strength. Must contain at least 10 characters and must contain both letters and digits
                
                // Check if the passwords match
                if ($password !== $confirmPassword) {
                    $message =  $message . "Passwords do not match.<br>";
                    
                } 
                if(checkPass($password) == false){
                    $message =  $message . "Password must contain at least 10 characters and must contain both letters and digits.<br>";
                    $passwordOK = false;
                }
                else {
                    $passwordOK = true;
                    $confirmPasswordOK = true;
                }
            }

            // Check if the phone number field is empty
            if (empty($_POST['phone'])) {
                $message =  $message . "Phone number is required.<br>";
            } else {
                $phone = htmlspecialchars($_POST['phone']);
                $phoneOK = true;
            }
            // Check if the date of birth field is empty
            if (empty($_POST['dob'])) {
                $message =  $message . "Date of birth is required.<br>";
            } else {
                $dob = htmlspecialchars($_POST['dob']);
                $dobOK = true;
            }

            // Check if the terms and conditions checkbox is checked
            if (isset($_POST['TandC']) && $_POST['TandC'] == 1) {
                $TandC = true;
            } else {
                $message =  $message . "Please accept the terms and conditions.<br>";
            }
        }

        // If there are validation errors, include the error message file
        if (!empty($message)) {
            include('errormsg.php');
        }

        // If all inputs are valid, proceed to registration success page
        if ($fNameOK && $lNameOK && $emailOK && $confirm_emailOK && $passwordOK && $confirmPasswordOK && $phoneOK && $dobOK &&$TandC) {
            // Store user's name and email in session
            session_start();
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            // Redirect to the registration success page
            $code = generateActivationCode(50);
            header('Location: login.php?activation_code='.$code);
            exit;
        }
    }
    ?>
    <br><div class="wrapper">
        <h2>Registration</h2>
        <form method="post" action="register.php">
            <div class="input-box">
                <!-- Input field for user's name -->
                <input type="text" name="fName" placeholder="Enter your First Name(*REQUIRED)" value="<?php print $fName; ?>" required>
            </div>
            <div class="input-box">
                <!-- Input field for user's name -->
                <input type="text" name="lName" placeholder="Enter your Last Name(*REQUIRED)" value="<?php print $lName; ?>" required>
            </div>
            <div class="input-box">
                <!-- Input field for user's email -->
                <input type="email" name="email" placeholder="Enter your Email (*REQUIRED)" value="<?php print $email ?>">
            </div>
            <div class="input-box">
                <!-- Input field for confirming user's email -->
                <input type="email" name="confirm_email" placeholder="Confirm your Email (*REQUIRED)" value="<?php print $confirmEmail ?>">
            </div>
            <div class="input-box">
                <!-- Input field for creating a password -->
                <input type="password" name="password" placeholder="Create Password (*REQUIRED)" value="<?php print $password ?>">
            </div>
            <div class="input-box">
                <!-- Input field for confirming the password -->
                <input type="password" name="confirm_password" placeholder="Confirm Password (*REQUIRED)" value="<?php print $confirmPassword ?>">
            </div>
            <div class="input-box">
            <input type="tel" id="phone" name="phone" class="phone-input" placeholder="10 Digit Phone Number(*REQUIRED)" pattern="[0-9]{10}" value="<?php print $phone ?>">
            </div>
            <div class="input-box">
                <!-- Input field for user's date of birth -->
                <p>Date of Birth(*REQUIRED)</p>
                <input type="date" name="dob" value="<?php print $dob ?>">
            </div>
            <div class="policy">
                <!-- Checkbox for terms and conditions acceptance -->
                <input type="checkbox" name="TandC" value="1">
                <h3>I accept all terms & condition(*REQUIRED)</h3>
            </div>
            <div class="input-box button">
                <!-- Submit button for registration -->
                <input type="Submit" value="Register Now">
            </div>
            <div class="text">
            <h3>Already have an account? <a href="login.php">Login now</a></h3>
            </div>
        </form>
    </div>
</body>

</html>