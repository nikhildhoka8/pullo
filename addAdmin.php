<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Add Admin</title>
</head>

<body class="main-layout">
    <div class="header_main">
        <?php require_once 'headerNav.php'; 
        require_once 'dbconnect.php';
        ?>
    </div>
    <?php
        if ($_SESSION['userType'] == '1') {
            require_once 'custSecondNav.php';
        } else if ($_SESSION['userType'] == '2') {
            require_once 'adminSecondNav.php';
        }
        if(isset($_POST['custSelect'])) {
            $email = $_POST['custSelect']; // Access the selected value from the <select>
            $stmt = $con->prepare("UPDATE USER_TABLE SET userTypeId = 2 WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        }
        $stmt = $con->prepare("SELECT * FROM USER_TABLE WHERE userTypeId = 1");
        $stmt->execute();

    ?>
    <div class="form-container">
        <form action="addAdmin.php" method =  "post">
            <h2>Add Admin</h2><br>
            <select name = "custSelect">
                <option value="0">Select User</option>
            <?php
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $name = $row->fName . " " . $row->lName;
                ?>
                    <option value="<?php echo $row->email ?>"><?php echo $name ?></option>
                <?php
                }
                ?>
            </select>
            <div class="input-box button">
                <input type="Submit" value="Add Admin">
            </div>
        </form>
    </div>
    <?php require_once 'footerNav.php'; ?>
</body>

</html>