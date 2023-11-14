<?php 
require_once 'dbconnect.php';
$stmt = $con->prepare("SELECT DISTINCT category FROM VW_STOCK WHERE activeStatus = TRUE");
$stmt->execute();
$category = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<div class="sneakers-secondary-nav">
    <?php foreach($category as $cat): ?>
        <a href="#<?php echo $cat; ?>"><?php echo $cat; ?></a>
    <?php endforeach; ?>
</div>
