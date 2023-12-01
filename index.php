<?php
session_start();
// echo $_SESSION['userType'];
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Pullo shoes</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
	<!-- header section start -->
	<div class="header_section">
		<?php 
		require_once 'headerNav.php';
		require_once 'dbconnect.php';
		?>
		<div class="banner_section">
			<div class="container-fluid">
				<section class="slide-wrapper">
    <div class="container-fluid">
	    <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->	
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
				<?php
				//select top 4 products from the database
				$stmt = $con->prepare("SELECT * FROM VW_PRODUCT WHERE activeStatus = TRUE LIMIT 4;");
				$stmt->execute();
				$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$i = 1;
				//print only 4 prodcuts
				foreach($products as $product){
					if($i != 1){
						echo '<div class="carousel-item">';
					}
					else{
						echo '<div class="carousel-item active">';
					}
					?>
                    <div class="row">
						<div class="col-sm-2 padding_0">
							<p class="mens_taital">Men Shoes</p>
							<div class="page_no"><?php echo $i; ?>/4</div>
							<p class="mens_taital_2">Men Shoes</p>
						</div>
						<div class="col-sm-5">
							<div class="banner_taital">
								<h1 class="banner_text"><?php print $product['category'] ?> </h1>
								<h1 class="mens_text"><strong><?php print $product['productName'] ?></strong></h1>
								<p class="lorem_text"><?php print $product['productDescription'] ?></p>
								<button class="buy_bt" onclick="window.location.href='./shoes.php#<?php print $product['category'] ?>'">Buy Now</button>
								<button class="more_bt" onclick = "window.location.href='./shoes.php'">See More</button>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="shoes_img"><img src="<?php print $product['productImageURL'] ?>"></div>
						</div>
					</div>
                </div>
				<?php
				$i++;
				}
				?>
            </div>
        </div>
    </div>
</section>			
			</div>
		</div>
	</div>
	<!-- header section end -->
	<!-- new collection section start -->
	<!-- new collection section end -->
	<?php
	$demo_products = array(
		array('name' => 'YEEZY 350 breds', 'price' => 50, 'imageURL' => 'images/yeezy-breds.png'),
		array('name' => 'Air Jordan 4 Retro Metallic Red', 'price' => 75, 'imageURL' => 'images/air-jordan-4-metallic-red.png.webp'),
		array('name' => 'Dior x Air Jordan 1', 'price' => 100, 'imageURL' => 'images/air-jordan-1-dior.png'),
	);
	?>
	<!-- New Arrivals section start -->
    <!-- <div class="layout_padding gallery_section">
    	<div class="container">
    		<div class="row">
    			<?php
				foreach($demo_products as $product){
					?>
					<div class="col-sm-4">
						<div class="best_shoes">
							<p class="best_text"><?php echo $product['name']; ?></p>
							<div class="shoes_icon"><img src="<?php echo $product['imageURL']; ?>"></div>
							<div class="star_text">
								<div class="left_part">
									<ul>
										<li><a href="#"><img src="images/star-icon.png"></a></li>
										<li><a href="#"><img src="images/star-icon.png"></a></li>
										<li><a href="#"><img src="images/star-icon.png"></a></li>
										<li><a href="#"><img src="images/star-icon.png"></a></li>
										<li><a href="#"><img src="images/star-icon.png"></a></li>
									</ul>
								</div>
								<div class="right_part">
									<div class="shoes_price">$ <span style="color: #ff4e5b;"><?php echo $product['price']; ?></span></div>
								</div>
							</div>
							<button class="buynow_bt">Add to Cart</button>
						</div>
					</div>
					<?php
				}
				?>
    		<div class="buy_now_bt">
    			<button class="buy_text" onclick="window.location.href='http://corsair2.cs.iupui.edu/~ndhoka/pullo/shoes.php'">Buy Now</button>
    		</div>
    	</div>
    </div> -->
   	<!-- contact section start -->
    <div class="layout_padding contact_section">
    	<div class="container">
    		<h1 class="new_text"><strong>Contact Now</strong></h1>
    	</div>
    	<div class="container-fluid ram">
    		<div class="row">
    			<div class="col-md-6">
    				<div class="email_box">
                    <div class="input_main">
                       <div class="container">
                          <form action="/action_page.php">
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Name" name="Name">
                            </div>
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Phone Numbar" name="Name">
                            </div>
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Email" name="Email">
                            </div>
                            
                            <div class="form-group">
                                <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                            </div>
                          </form>   
                       </div> 
                       <div class="send_btn">
                        <button class="main_bt">Send</button>
                       </div>                   
                    </div>
    		</div>
    			</div>
    			<div class="col-md-6">
    				<div class="shop_banner">
    					<div class="our_shop">
						<button class="out_shop_bt" onclick="window.location.href='http://corsair2.cs.iupui.edu/~ndhoka/pullo/shoes.php'">Our Collection</button>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
   	<!-- contact section end -->
	<!-- section footer start -->
    <?php require_once 'footerNav.php';?>
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
         $(document).ready(function(){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         
         
$('#myCarousel').carousel({
            interval: false
        });

        //scroll slides on swipe for touch enabled devices

        $("#myCarousel").on("touchstart", function(event){

            var yClick = event.originalEvent.touches[0].pageY;
            $(this).one("touchmove", function(event){

                var yMove = event.originalEvent.touches[0].pageY;
                if( Math.floor(yClick - yMove) > 1 ){
                    $(".carousel").carousel('next');
                }
                else if( Math.floor(yClick - yMove) < -1 ){
                    $(".carousel").carousel('prev');
                }
            });
            $(".carousel").on("touchend", function(){
                $(this).off("touchmove");
            });
        });
	});
      </script> 
   </body>
</html>