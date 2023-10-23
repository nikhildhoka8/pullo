<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Profile</title>
</head>
<body>
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php require_once 'adminSecondNav.php';
    require_once 'dbconnect.php';
    $message = '';
    $categoryNameOK = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['categoryName']) && !empty($_POST['categoryName'])){
            //Check for duplicate category name after removing all upper cases and removing spaces
            $stmt = $con->prepare("SELECT * FROM CATEGORY WHERE REPLACE(UPPER(categoryName), ' ', '') = REPLACE(UPPER(?), ' ', '')");
            $stmt->execute([$_POST['categoryName']]);
            $selectedCategory = $stmt->fetch(PDO::FETCH_ASSOC);
            if($selectedCategory){
                $message .= 'Category Name already exists.<br>';
                include './registration/errormsg.php';
            }
            else{
            $categoryName = htmlspecialchars($_POST['categoryName']);
            $categoryNameOK = true;
            }
        }
        else{
            $message .= 'Category Name is required.<br>';
            include './registration/errormsg.php';
        }
        if($categoryNameOK){
            $stmt = $con->prepare("INSERT INTO CATEGORY (categoryName) VALUES (?)");
            $stmt->execute([$categoryName]);
        }
    }
    ?>
    <div class="form-container">
        <form action="addCategory.php" method="post">
            <h2>Add Category</h2>
            <div class="input-box">
                <label for="categoryName">Category Name (*REQUIRED)</label><br>
                <input type="text" name="categoryName" value="" ><br>
            </div>
            <div class="input-box button">
                <!-- Submit button for login -->
                <input type="Submit" value="Add">
            </div>
        </form>
    </div>
    <?php require_once 'footerNav.php';?>
</body>
</html>