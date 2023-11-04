<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Search by Last Name</title>
    <script>
        //Ajax tutorial - http://www.w3schools.com/ajax/
        function showHint(str) {
            var xmlhttp;
            if (str.length == 0) {
                document.getElementById("lName").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "getName.php?q=" + str, true);
            
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("recommendation").innerHTML = xmlhttp.responseText;
                    console.log(xmlhttp.responseText);
                }
            }
            xmlhttp.send();
            
        }
    </script>
</head>

<body class="main-layout">
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php
    if (isset($_SESSION['user'])) {
        if ($_SESSION['userType'] == '1') {
            require_once 'custSecondNav.php';
        } else if ($_SESSION['userType'] == '2') {
            require_once 'adminSecondNav.php';
        }
    }
    ?>

    <div class="form-container">
        <form action="displayLname.php" method="POST">
            <h2>Start typing a Last Name in the input field below:
            </h2>
                <div class="input-box">
                    <label>Last Name</label>
                    <input type="text" list="recommendation" name="lName" value="" onkeyup="showHint(this.value)">
                    <datalist id="recommendation">
                    </datalist>
                </div>
                <div class="input-box button">
                <!-- Submit button for login -->
                <input type="Submit" value="Submit">
                </div>
        </form>
    </div>
    <?php require_once 'footerNav.php'; ?>
</body>

</html>