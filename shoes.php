<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    session_start();
    require_once 'head.php'; 
    ?>
    <title>Shoes</title>
    <style>
        .new_text {
            padding-top: 100px;
        }
        .best_shoes {
            /* make the box bigger by making it of the lenght as much as it its contents*/
            height: 100%;
            width: 100%;
            border: 1px solid black;
            padding: 10px;
        }
        .input-box {
            margin-bottom: 200px !important;
        }
    </style>
</head>

<!-- body -->

<body class="main-layout">
    <!-- header section start -->

    <div class="header_section header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <!-- New Arrivals section start -->

    <!-- <div class="collection_text">Sneakers</div> -->
    <div class="layout_padding gallery_section">
    <?php require_once 'sneakersSecondNav.php'; 
    $stmt = $con->prepare("SELECT * FROM CATEGORY WHERE activeStatus = TRUE");
    $stmt->execute();

    while ($categoryRow = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmtStock = $con->prepare("SELECT DISTINCT productId, productName, productImageURL, productDescription, brand, category, price, gender FROM VW_STOCK WHERE activeStatus = TRUE and category = ?;");
        $stmtStock->bindParam(1, $categoryRow['categoryName']);
        $stmtStock->execute();

        $i = 1;
        echo '<div class="container" id="' . $categoryRow['categoryName'] . '">';
        echo '<h1 class="new_text"><strong>' . $categoryRow['categoryName'] . '</strong></h1>';

        while ($stockRow = $stmtStock->fetch(PDO::FETCH_ASSOC)) {
            if ($i % 3 == 1) {
                echo '<div class="row">';
            }

            echo '<div class="col-sm-4">';
            echo '<div class="best_shoes">';
            echo '<p class="best_text">' . $stockRow['productName'] . '</p>';
            echo '<div class="shoes_icon"><img src="' . $stockRow['productImageURL'] . '" height="330px" width="230px"s></div>';
            echo '<div class="star_text">';
            echo '<div class="left_part">';
            echo '<ul>';
            echo '<li>Category: ' . $stockRow['category'] . '</li>';
            echo '<li>Brand: ' . $stockRow['brand'] . '</li>';
            echo '<li>Gender: ' . $stockRow['gender'] . '</li>';
            echo '</ul>';
            echo '</div>';
            echo '<div class="right_part">';
            echo '<div class="shoes_price">$ <span style="color: #ff4e5b;">' . $stockRow['price'] . '</span></div>';
            echo '</div>';
            echo '</div>';
            // Missing closing div tag here
            // echo '<div class="form-container">';
            echo '<form action="addCart.php" method="get">';
            echo '<input type="hidden" name="productId" value="' . $stockRow['productId'] . '">';
            echo '<div class="input-box">';
            echo '<label for="size">Select Size: (*REQUIRED)</label><br>';
            
            echo '<select name="size" class="nice-select" hidden required>';
            echo '<option value="">Select Size</option>';
            $stmtSize = $con->prepare("SELECT DISTINCT SIZE.sizeId, SIZE.size FROM STOCK JOIN SIZE ON STOCK.sizeId = SIZE.sizeId WHERE STOCK.productId = ?;");
            $stmtSize->bindParam(1, $stockRow['productId']);
            $stmtSize->execute(); // Execute the query before fetching results
            
            // Fetch all rows from the result set
            $sizes = $stmtSize->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($sizes as $size) {
                echo "<option value='" . $size['sizeId'] . "'>" . $size['size'] . "</option>";
            }
            
            echo '</select><br>';
            echo '</div>';
            echo '<div class="input-box button">';
            echo '<!-- Submit button for login -->';
            echo '<input type="Submit" value="Add">';
            echo '</div>';
            echo '</form>';
            // echo '</div>';

            echo '</div>';
            echo '</div>';

            if ($i % 3 == 0) {
                echo '</div>';
            }

            $i++;
        }

        if ($i % 3 != 1) {
            echo '</div>';
        }

        echo '</div>';
    }
    ?>
    </div>

    <!-- New Arrivals section end -->
    <!-- section footer start -->
    <?php require_once 'footerNav.php'; ?>
    <!-- section footer end -->


    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript -->
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });


            $('#myCarousel').carousel({
                interval: false
            });

            //scroll slides on swipe for touch enabled devices

            $("#myCarousel").on("touchstart", function(event) {

                var yClick = event.originalEvent.touches[0].pageY;
                $(this).one("touchmove", function(event) {

                    var yMove = event.originalEvent.touches[0].pageY;
                    if (Math.floor(yClick - yMove) > 1) {
                        $(".carousel").carousel('next');
                    } else if (Math.floor(yClick - yMove) < -1) {
                        $(".carousel").carousel('prev');
                    }
                });
                $(".carousel").on("touchend", function() {
                    $(this).off("touchmove");
                });
            });
        });
    </script>
</body>

</html>
