<!-- cart.php -->
<?php
session_start();

// Dummy product data for demonstration
$products = array(
    array('name' => 'Yeezy Boost 350 V2 Black Red', 'price' => 50, 'quantity' => 2),
    array('name' => 'Jordan Off White', 'price' => 75, 'quantity' => 1)
);

// Initialize the cart if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = $products;
}

// Function to update quantity
function updateQuantity($key, $quantity)
{
    $_SESSION['cart'][$key]['quantity'] = $quantity;
}

// Function to remove item
function removeItem($key)
{
    unset($_SESSION['cart'][$key]);
}

?>
<?php
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $key = $_POST['update'];
        $quantity = $_POST['quantity'][$key];
        updateQuantity($key, $quantity);
    } elseif (isset($_POST['remove'])) {
        $key = $_POST['remove'];
        removeItem($key);
    } elseif (isset($_POST['checkout'])) {
        // Implement your checkout logic here
        // Redirect to the checkout page or handle as needed
        header('Location: checkout.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .quantity-input {
            width: 40px;
        }
    </style>
    <!-- basic -->
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Collection</title>
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
<body class="main-layout">

<!-- Header section -->
<div class="header_section header_main">
    <?php include 'headerNav.php';?>
</div>

<!-- Cart Listing -->
<div class="collection_text">Shopping Cart</div>

<form method="post" action="cart.php">

    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

        <?php foreach ($_SESSION['cart'] as $key => $product) : ?>
            <tr>
                <td><?= $product['name']; ?></td>
                <td>$<?= $product['price']; ?></td>
                <td>
                    <input class="quantity-input" type="number" name="quantity[<?= $key; ?>]"
                           value="<?= $product['quantity']; ?>" min="1">
                </td>
                <td>$<?= $product['price'] * $product['quantity']; ?></td>
                <td>
                    <button type="submit" name="update" value="<?= $key; ?>">Update</button>
                    <button type="submit" name="remove" value="<?= $key; ?>">Remove</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div>
        <button type="submit" name="checkout">Proceed to Checkout</button><br>
    </div>
</form>



<!-- Footer section -->
<?php include 'footerNav.php';?>


</body>
</html>