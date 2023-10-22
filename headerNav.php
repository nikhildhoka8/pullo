<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="logo"><a href="#"><img src="images/logo.png"></a></div>
        </div>
        <div class="col-sm-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="index.php">Home</a>
                        <!-- <a class="nav-item nav-link" href="collection.php">Collection</a> -->
                        <a class="nav-item nav-link" href="shoes.php">Sneakers</a>
                        <!-- <a class="nav-item nav-link" href="racing boots.php">Boots</a> -->
                        <?php
                        // Check if the user is logged in
                        // You need to replace the condition below with your actual logic to check if the user is logged in

                        if (isset($_SESSION['userId'])) {
                            echo '<a class="nav-item nav-link last" href="./userProfile.php"><img src="images/account-symbol.png"></a>';
                        } else {
                            echo '<a class="nav-item nav-link last" href="./registration/register.php"><img src="images/account-symbol.png"></a>';
                        }
                        ?>
                        <a class="nav-item nav-link last" href="cart.php"><img src="images/shop_icon.png"></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>