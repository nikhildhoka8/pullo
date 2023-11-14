<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Update Stock</title>
</head>

<body class="main-layout">
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php
    require_once 'adminSecondNav.php';
    $productName = $size = $quantity = $productId = "";
    $productNameOK = $sizeOK = $quantityOK = false;
        $stockId = $_GET['stockId'];
        $stmt = $con->prepare("SELECT * FROM VW_STOCK WHERE stockId = :stockId");
        $stmt->bindParam(':stockId', $stockId);
        $stmt->execute();
        $stock = $stmt->fetch(PDO::FETCH_ASSOC);
        $productName = $stock['productName'];
        //find the sizeId of the size
        $stmt = $con->prepare("SELECT * FROM SIZE WHERE size = :size");
        $stmt->bindParam(':size', $stock['size']);
        $stmt->execute();
        $size = $stmt->fetch(PDO::FETCH_ASSOC);
        $selectedSize = $size['sizeId'];
        $quantity = $stock['stockQuantity'];
        $message = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['productName']) && !empty($_POST['productName'])) {
            //check the if the product Name entered is a valid product name
            $stmt = $con->prepare("SELECT * FROM PRODUCT WHERE productName = :productName");
            $stmt->bindParam(':productName', $_POST['productName']);
            $stmt->execute();
            while($product = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($product['productName'] == $_POST['productName']){
                    $productName = $_POST['productName'];
                    $productId = $product['productId'];
                    $productNameOK = true;
                }
            }
            if(!$productNameOK){
                $message .= "Product Name is not valid.<br>";
            }
        }
        else{
            $message .= "Product Name is required.<br>";
        }
        //check if the size is selected. if not display error message
        if (isset($_POST['size']) && !empty($_POST['size'])) {
            $size = $_POST['size'];
            $sizeOK = true;
        }
        else{
            $message .= "Size is required.<br>";
        }
        //check if the quantity is entered. if not display error message. Make sure that quantity is greater than 0
        if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
            if($_POST['quantity'] > 0){
                $quantity = $_POST['quantity'];
                $quantityOK = true;
            }
            else{
                $message .= "Quantity must be greater than 0.<br>";
            }
        }
        else{
            $message .= "Quantity is required.<br>";
        }
        if(!empty($message)){
            require_once './registration/errormsg.php';
        }
        //if all the fields are entered correctly, add the stock to the database
        if($quantityOK && $sizeOK && $productNameOK){
            //insert in the stock table that stores the prouct ID, size ID and quantity
            $stmt = $con->prepare("SELECT * FROM STOCK WHERE productId = :productId AND sizeId = :sizeId");
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':sizeId', $size);
            $stmt->execute();
            $stock = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stock){
                $stmt = $con->prepare("UPDATE STOCK SET quantity = :quantity WHERE productId = :productId AND sizeId = :sizeId");
                $stmt->bindParam(':productId', $productId);
                $stmt->bindParam(':sizeId', $size);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->execute();
            }
            else{
                $stmt = $con->prepare("INSERT INTO STOCK (productId, sizeId, quantity) VALUES (:productId, :sizeId, :quantity)");
                $stmt->bindParam(':productId', $productId);
                $stmt->bindParam(':sizeId', $size);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->execute();
            }
            header("Location: viewStock.php");
        }
    }
    
    ?>
    <div class="form-container">
        <form action="updateStock.php?stockId=<?php echo $stockId?>" method="post">
            <div class="input-box">
                <label for="productName">Product Name (*REQUIRED)</label><br>
                <input type="text" name="productName" value="<?php echo $productName; ?>"><br>
            </div>
            <div class="input-box">
                <label for="size">Size (*REQUIRED)</label><br>
                <select name="size">
                    <?php
                    $stmt = $con->prepare("SELECT * FROM SIZE");
                    $stmt->execute();
                    while ($size = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        if ($size['sizeId'] == $selectedSize) {
                            echo '<option value="' . $size['sizeId'] . '" selected>' . $size['size'] . '</option>';
                        } else {
                            echo '<option value="' . $size['sizeId'] . '">' . $size['size'] . '</option>';
                        }
                    }
                    ?>
                </select><br>
            </div>
            <div class="input-box">
                <label for="quantity">Quantity</label><br>
                <input type="number" name="quantity" value="<?php echo $quantity; ?>"><br>
            </div>
            <div class="input-box button">
                <!-- Submit button for login -->
                <input type="Submit" value="Update">
            </div>
        </form>
    </div>
    <?php require_once 'footerNav.php'; ?>
</body>

</html>