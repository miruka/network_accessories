<!-- E-commerce for network Devices-->

<?php
require_once 'core/init.php';

include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/headerfull.php';
include 'includes/leftbar.php';

$sql = "SELECT * FROM products WHERE featured = 1";
$featured = mysqli_query($db, $sql);

?>


<!-- Main Content-->
<div class="col-md-8">
    <div class="row">
        <h2 class="text-center">Featured Products</h2>

        <?php while ($product = mysqli_fetch_assoc($featured)) : ?>
            <div class="col-md-3">
                <h4><?= $product['title']; ?></h4>
                <img src="<?= $product['image']; ?>" alt="<?= $product['title']; ?>" class="img-thumbn">
                <p class="list-price text-danger">List Price: <s>Ksh <?= $product['list_price']; ?></s></p>
                <p class="price">Our Price: Ksh <?= $product['price']; ?></p>
                <button class="btn btn-sm btn-success" onclick="detailsmodal(<?= $product['id']; ?>)">Details</button>
            </div>
        <?php endwhile; ?>


    </div>
</div>

<?php

include 'includes/rightbar.php';
include 'includes/footer.php';
?>