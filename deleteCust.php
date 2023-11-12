<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once 'dbconnect.php';
    $userId = $_GET['userId'];
    $stmt = $con->prepare('UPDATE USER_TABLE SET activeStatus = FALSE WHERE userId = ?');
    $stmt->execute([$userId]);
    header('Location: ./viewCust.php');
}
else{
    header('Location: ./userProfile.php');
}
?>