<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'head.php';?>
    <title>Add Brand</title>
</head>
<body>
<div class="header_main">
        <?php require_once 'headerNav.php';?>
    </div>
    <?php require_once 'adminSecondNav.php';
    require_once 'dbconnect.php';
    $message = '';
    $brandNameOK = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['brandName']) && !empty($_POST['brandName'])){
            //Check for duplicate brand name after removing all upper cases and removing spaces
            $stmt = $con->prepare("SELECT * FROM BRAND WHERE REPLACE(UPPER(brandName), ' ', '') = REPLACE(UPPER(?), ' ', '')");
            $stmt->execute([$_POST['brandName']]);
            $selectedBrand = $stmt->fetch(PDO::FETCH_ASSOC);
            if($selectedBrand){
                $message .= 'Brand Name already exists.<br>';
                include './registration/errormsg.php';
            }
            else{
                $brandName = htmlspecialchars($_POST['brandName']);
                $brandNameOK = true;
            }   
        }
        else{
            $message .= 'Brand Name is required.<br>';
            include './registration/errormsg.php';
        }
        if($brandNameOK){
            $stmt = $con->prepare("INSERT INTO BRAND (brandName) VALUES (?)");
            $stmt->execute([$brandName]);
        }
    }
    ?>
    <div class="form-container">
        <form action="addBrand.php" method="post">
            <h2>Add Brand</h2>
            <div class="input-box">
                <label for="brandName">Brand Name (*REQUIRED)</label><br>
                <input type="text" name="brandName" value="" ><br>
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