<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>Profile</title>
</head>

<body>
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php require_once 'adminSecondNav.php'; ?>
    <div class="form-container">
        <form action="addProduct.php" method="post">
            <h2>Add Product</h2>
            <div class="input-box">
                <label for="prodName">Product Name</label><br>
                <input type="text" name="prodName" value=""><br>
            </div>
            <div class="input-box">
                <label for="prodDesc">Product Description</label><br>
                <input type="text" name="prodDesc" value=""><br>
            </div>
            <div class="input-box">
                <label for="prodPrice">Product Price</label><br>
                <input type="number" name="prodPrice" value=""><br>
            </div>
            <div class="input-box">
                <label for="prodQty">Product Quantity</label><br>
                <input type="number" name="prodQty" value=""><br>
            </div>
            <div class="input-box">
                <label for="prodSize">Product Size</label><br>
                <select name="prodSize">
                    <option value="0">6</option>
                    <option value="1">7</option>
                </select><br>
            </div>
            <div class="file-input">
                <label for="prodImg">Product Image</label><br>
                <input type="file" name="prodImg" accept=".jpg, .jpeg, .png"><br>
            </div>
            <div class="input-box">
                <label for="prodBrand">Product Brand</label><br>
                <select name="prodBrand">
                    <option value="0">Adidas</option>
                    <!-- <?php
                    // $sql = "SELECT * FROM brand";
                    // $result = mysqli_query($conn, $sql);
                    // while ($row = mysqli_fetch_assoc($result)) {
                    //     echo "<option value='" . $row['brandId'] . "'>" . $row['brandName'] . "</option>";
                    // }
                    ?> -->
                </select><br>
            </div>
            <div class="input-box">
                <label for="prodCat">Product Category</label><br>
                <select name="prodCat">
                    <option value="0">Dunks</option>
                    <!-- <?php
                    // $sql = "SELECT * FROM category";
                    // $result = mysqli_query($conn, $sql);
                    // while ($row = mysqli_fetch_assoc($result)) {
                    //     echo "<option value='" . $row['catId'] . "'>" . $row['catName'] . "</option>";
                    // }
                    ?> -->
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