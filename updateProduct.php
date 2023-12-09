<?php
session_start();
require_once 'dbconnect.php';
require_once './registration/util/funcs.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Update Product</title>
</head>

<body class="main-layout">
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php
    require_once 'adminSecondNav.php';
    $productName = $productDescription = $price = $productImageURL = $brandName = $gender = $categoryName = "";
    $productNameOK = $productDescriptionOK = $priceOK = $productImageURLOK = $brandNameOK = $genderOK = $categoryNameOK = false;
    $message = "";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['productId'])) {
            $productId = $_GET['productId'];
            $stmt = $con->prepare("SELECT * FROM VW_PRODUCT WHERE productId = :productId");
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            $productName = $product['productName'];
            $productDescription = $product['productDescription'];
            $price = $product['price'];
            $productImageURL = $product['productImageURL'];
            $brandName = $product['brand'];
            $categoryName = $product['category'];
            $gender = $product['gender'];
        } else {
            header('Location: error.php?message=Invalid Access');
            exit();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // check for all the entries and then update the database
        $productId = $_POST['productId'];
        if (isset($_POST['productName']) && !empty($_POST['productName'])) {
            $productName = $_POST['productName'];
            $productNameOK = true;
        } else {
            $message .= "Product Name is required.<br>";
        }

        if (isset($_POST['productDescription']) && !empty($_POST['productDescription'])) {
            $productDescription = $_POST['productDescription'];
            $productDescriptionOK = true;
        } else {
            $message .= "Product Description is required.<br>";
        }

        if (isset($_POST['price']) && !empty($_POST['price'])) {
            $price = htmlspecialchars($_POST['price']);
            $priceOK = true;
        } else {
            $message .= "Price is required.<br>";
        }

        if ($_POST['price'] < 0) {
            $message .= "Price must be a positive number <br>";
        }

        if (isset($_POST['productImageUpdate']) && $_POST['productImageUpdate'] == 'yes') {
            if (isset($_FILES['productImageURL']) && !empty($_FILES['productImageURL'])) {
                // Validate and sanitize the file input
                $productImageURL = move_uploaded_file($_FILES['productImageURL']['tmp_name'], './images/' . $_FILES['productImageURL']['name']);
                if ($productImageURL !== false) {
                    $productImageURLOK = true;
                } else {
                    $message .= "Invalid image file format or size. Please upload a valid image file.<br>";
                }
            } else {
                $message .= "Product Image is required.<br>";
            }
        } else if (isset($_POST['productImageUpdate']) && $_POST['productImageUpdate'] == 'no') {
            $productImageURLOK = true;
        }

        if (isset($_POST['brandName']) && !empty($_POST['brandName'])) {
            $brandName = $_POST['brandName'];
            $brandNameOK = true;
        } else {
            $message .= "Brand Name is required.<br>";
        }

        if (isset($_POST['categoryName']) && !empty($_POST['categoryName'])) {
            $categoryName = $_POST['categoryName'];
            $categoryNameOK = true;
        } else {
            $message .= "Category Name is required.<br>";
        }

        if (isset($_POST['gender']) && !empty($_POST['gender'])) {
            $gender = $_POST['gender'];
            $genderOK = true;
        } else {
            $message .= "Gender is required.<br>";
        }

        if ($productNameOK && $productDescriptionOK && $priceOK && $brandNameOK && $categoryNameOK && $genderOK && $productImageURLOK) {
            // update the product in the database
            //print all the data and exit the script 
            // print_r($_POST);
            $data = array($productName, $productDescription, $price, $gender, $brandName, $categoryName, $productId);
            $stmtUpdateProduct = $con->prepare("UPDATE PRODUCT SET productName = ?, productDescription = ?, price = ?, genderId = ?, brandId = ?, categoryId = ? WHERE productId = ?");
            $stmtUpdateProduct->execute($data);

            // print the query with all the params
            // $query = $stmtUpdateProduct->queryString;
            // $params = $stmtUpdateProduct->debugDumpParams();
            // print $query;
            // print $params;
            // exit();
            if ($stmtUpdateProduct->execute()) {
                Header('Location: viewProducts.php?message=Product Updated Successfully');
                exit(); // Important: terminate the script after redirection
            } else {
                $message .= "Error updating product. Please try again.<br>";
            }
        }
    }

    if (!empty($message)) {
        include './registration/errormsg.php';
    }
    ?>
    <div class="form-container">
        <form action="updateProduct.php" method="POST" enctype="multipart/form-data">
            <h2>Update Product</h2>
            <input type="hidden" name="productId" value="<?php echo $productId ?>">
            <div class="input-box">
                <label for="productName">Product Name: (*REQUIRED)</label><br>
                <input type="text" name="productName" value="<?php echo $productName ?>"><br>
            </div>
            <div class="input-box">
                <label for="productDescription">Product Description: (*REQUIRED)</label><br>
                <input type="text" name="productDescription" value="<?php echo $productDescription ?>"><br>
            </div>
            <div class="input-box">
                <label for="price">Product Price: (*REQUIRED)</label><br>
                <input type="number" name="price" value="<?php echo $price ?>"><br>
            </div>

            <div class="input-box">
                <label for="productImageUpdate">Do you want to update the image? (*REQUIRED)</label><br>
                <select name="productImageUpdate" onchange="enableImage(this.value)">
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                </select><br>
            </div>
            <script>
                function enableImage(value) {
                    document.getElementById("productImage").hidden = value === 'no';
                    document.getElementById("productImageURL").hidden = value === 'no';

                }
            </script>
            <div class="input-box" id="productImage" hidden>
                <label for="productImageURL">Enter a New Image</label><br>
                <input type="file" name="productImageURL" id="productImageURL" hidden><br>
            </div>
            <div class="input-box">
                <label for="brandName">Product Brand: (*REQUIRED)</label><br>
                <select name="brandName">
                    <option value="">Select Brand</option>
                    <?php
                    $stmtBrand = $con->prepare("SELECT * FROM BRAND");
                    $stmtBrand->execute();
                    while ($brand = $stmtBrand->fetch(PDO::FETCH_ASSOC)) {
                        if ($brand['brandName'] == $brandName) {
                            echo "<option value='" . $brand['brandId'] . "' selected>" . $brand['brandName'] . "</option>";
                        } else {
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
                    while ($rowGender = $stmtGender->fetch(PDO::FETCH_ASSOC)) {
                        if ($rowGender['genderName'] == $gender) {
                            echo "<option value =' " . $rowGender['genderId'] . " ' selected>" . $rowGender['genderName'] . "</option>";
                        } else {
                            echo "<option value =' " . $rowGender['genderId'] . " '>" . $rowGender['genderName'] . "</option>";
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
                    while ($category = $stmtCategory->fetch(PDO::FETCH_ASSOC)) {
                        if ($category['categoryName'] == $categoryName) {
                            echo "<option value='" . $category['categoryId'] . "' selected>" . $category['categoryName'] . "</option>";
                        } else {
                            echo "<option value='" . $category['categoryId'] . "'>" . $category['categoryName'] . "</option>";
                        }
                    }
                    ?>
                </select><br>
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