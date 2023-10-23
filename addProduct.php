<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Add Product</title>
</head>

<body>
    <div class="header_main">
        <?php require_once 'headerNav.php';
        ?>
    </div>
    <?php 
    require_once 'adminSecondNav.php'; 
    require_once 'dbconnect.php';
    //check user input before entering into database. All fields are required
    $productName = $productDescription = $price  = $gender = $productImageURL = $brandName = $categoryName = "";
    $productNameOK = $productDescriptionOK = $priceOK = $genderOK = $productImageURLOK = $brandNameOK = $categoryNameOK = false;
    $message = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_POST['productName'])){
            $message .= "Product Name is Required <br>";
        }
        if(strlen($_POST['productName']) > 50){
            $message .= "Product Name must be less than 50 characters <br>";
        }
        $productNameModified = strtolower(str_replace(' ', '', $_POST['productName']));
        // Check if a product with the modified name exists in the database
        $stmtProductName = $con->prepare("SELECT * FROM PRODUCT WHERE LOWER(REPLACE(productName, ' ', '')) = :productNameModified");
        $stmtProductName->bindParam(':productNameModified', $productNameModified);
        $stmtProductName->execute();
        if ($stmtProductName->rowCount() > 0) {
            $message .= "Product Name already exists <br>";
        } else {
            $productName = htmlspecialchars($_POST['productName']);
            $productNameOK = true;
        }
        if(empty($_POST['productDescription'])){
            $message .= "Product Description is Required <br>";
        }else{
            $productDescription = htmlspecialchars($_POST['productDescription']);
            $productDescriptionOK = true;
        }
        if(empty($_POST['price'])){
            $message .= "Price is Required <br>";
        }
        if($_POST['price'] < 0){
            $message .= "Price must be a positive number <br>";
        }
        else{  
            $price = htmlspecialchars($_POST['price']);
            $priceOK = true;
        }
        if(empty($_POST['gender'])){
            $message .= "Gender is required <br>";
        }else{
            $gender = htmlspecialchars($_POST['gender']);
            $genderOK = true;
        }
        if(empty($_POST['brandName'])){
            $message .= "Brand Name is required <br>";
        }else{
            $brandName = htmlspecialchars($_POST['brandName']);
            $brandNameOK = true;
        }
        if(empty($_POST['categoryName'])){
            $message .= "Category Name is required <br>";
        }else{
            $categoryName = htmlspecialchars($_POST['categoryName']);
            $categoryNameOK = true;
        }
        if(empty($_FILES['productImageURL']['name'])){
            $message .= "Product Image is required <br>";
        }else{
            // echo $_FILES['productImageURL']['name'];
            $productImageURLOK = true;

        }
        if(!empty($message)){
            require_once './registration/errormsg.php';
        }
        if($productNameOK && $productDescriptionOK && $priceOK && $genderOK && $productImageURLOK && $brandNameOK && $categoryNameOK){
            //Insert into database
            $stmtFinal = $con->prepare("INSERT INTO PRODUCT (productName, productDescription, price, genderId, brandId, categoryId) VALUES (?, ?, ?, ?, ?, ?) ");
            if($stmtFinal->execute([$productName, $productDescription, $price, $gender, $brandName, $categoryName])){
                $productId = $con->lastInsertId();
                if (isset($_FILES["productImageURL"]["name"])) {
                    // Define the directory where you want to save the image
                    $uploadDirectory = 'images/';
                
                    // Create a unique filename based on the product ID, but keep the same file type
                    $imageFileName = 'product_' . $productId . '.' . pathinfo($_FILES['productImageURL']['name'], PATHINFO_EXTENSION);
                    
                    echo $imageFileName;
                    // Move the uploaded image to the specified directory
                    if (move_uploaded_file($_FILES["productImageURL"]["tmp_name"], ( $uploadDirectory . $imageFileName))) {
                        // Update the product record with the image filename
                        $stmtUpdateImage = $con->prepare("UPDATE PRODUCT SET productImageURL = :imageFileName WHERE productId = :productId");
                        $stmtUpdateImage->bindParam(':imageFileName', $imageFileName);
                        $stmtUpdateImage->bindParam(':productId', $productId);
                
                        if ($stmtUpdateImage->execute()) {
                            header('Location: viewProducts.php?message=Product Added Successfully');
                            exit();
                        } else {
                            // Handle the case where the update query fails
                            echo "Error updating the product image.";
                        }
                    } 
                    else {
                        // Handle the case where moving the uploaded file fails
                        echo "Error moving the uploaded file.";
                    }
                }
            }
        }
    }
    ?>
    <div class="form-container">
        <form action="addProduct.php" method="post" enctype="multipart/form-data">
            <h2>Add Product</h2>
            <div class="input-box">
                <label for="productName">Product Name: (*REQUIRED)</label><br>
                <input type="text" name="productName" value="<?php echo $productName?>"><br>
            </div>
            <div class="input-box">
                <label for="productDescription">Product Description: (*REQUIRED)</label><br>
                <input type="text" name="productDescription" value="<?php echo $productDescription?>"><br>
            </div>
            <div class="input-box">
                <label for="price">Product Price: (*REQUIRED)</label><br>
                <input type="number" name="price" value="<?php echo $price?>"><br>
            </div>
            <div class="file-input">
                <label for="productImageURL">Product Image: (*REQUIRED)</label><br>
                <input type="file" name="productImageURL" accept=".jpg, .jpeg, .png"><br>
            </div>
            <div class="input-box">
                <label for="brandName">Product Brand: (*REQUIRED)</label><br>
                <select name="brandName">
                    <option value="">Select Brand</option>
                    <?php
                    $stmtBrand = $con->prepare("SELECT * FROM BRAND");
                    $stmtBrand->execute();
                    while($brand = $stmtBrand->fetch(PDO::FETCH_ASSOC)){
                        if($brand['brandId'] == $selectedBrand){
                            echo "<option value='" . $brand['brandId'] . "' selected>" . $brand['brandName'] . "</option>";
                        }else{
                            echo "<option value='" . $brand['brandId'] . "'>" . $brand['brandName'] . "</option>";
                        }
                    }
                    ?>
                </select><br>
            </div>
            <div class="input-box">
                <label for="gender">Gender (*REQUIRED)</label><br>
                <select name="gender">
                    <option value=""> Select Gender</option>
                    <?php
                    $stmtGender = $con->prepare("SELECT * FROM GENDER");
                    $stmtGender->execute();
                    while($gender = $stmtGender->fetch(PDO::FETCH_ASSOC)){
                        if($gender['genderId'] == $gender){
                            echo "<option value =' " .$gender['genderId'] . " ' selected>" .$gender['genderName'] . "</option>";
                        }
                        else{
                            echo "<option value =' " .$gender['genderId'] . " '>" .$gender['genderName'] . "</option>";
                        }
                    }
                    ?>

                </select>
            </div>
            <div class="input-box">
                <label for="categoryName">Product Category: (*REQUIRED)</label><br>
                <select name="categoryName">
                    <option value="">Select Category</option>
                    <?php
                    $stmtCategory = $con->prepare("SELECT * FROM CATEGORY");
                    $stmtCategory->execute();
                    while($category = $stmtCategory->fetch(PDO::FETCH_ASSOC)){
                        if($category['categoryId'] == $selectedCategory){
                            echo "<option value='" . $category['categoryId'] . "' selected>" . $category['categoryName'] . "</option>";
                        }else{
                            echo "<option value='" . $category['categoryId'] . "'>" . $category['categoryName'] . "</option>";
                        }
                    }
                    ?>
                </select><br>
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