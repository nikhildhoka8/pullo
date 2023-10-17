<?php 
$category = array("Jordan", "Yeezy");
?>
<div class="sneakers-secondary-nav">
    <?php foreach($category as $cat): ?>
        <a href="#<?php echo $cat; ?>"><?php echo $cat; ?></a>
    <?php endforeach; ?>
</div>
