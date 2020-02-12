<?php
require_once '../core/init.php';

$id = $_POST['id'];
$id = (int) $id;
$sql = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($db, $sql);
$product = mysqli_fetch_assoc($result);

$brand_id = $product['brand'];
$sql = "SELECT brand FROM brand WHERE id = '$brand_id'";
$brand_query = mysqli_query($db, $sql);
$brand = mysqli_fetch_assoc($brand_query);

$sizestring = $product['sizes'];
$size_array = explode(',', $sizestring);


?>

<!--Details Light Box-->
<? ob_start(); ?>

<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" onclick="closemodal()" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-center"><?= $product['title']; ?></h4>

            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="center-block">
                                <img src="<?= $product['image']; ?>" alt="<?= $product['title']; ?>" class="details img-responsive">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h4>Details</h4>
                            <p><?= $product['description']; ?></p>
                            <hr>
                            <p>Price: Ksh <?= $product['price']; ?></p>
                            <p>Brand: <?= $brand['brand']; ?></p>
                            <form action="add_cart.php" method="post">
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="quantity">Quantity:</label>
                                        <input type="text" class="form-control" id="quantity" name="quantity">
                                    </div>
                                    <div class="col-xs-9"></div>


                                </div><br><br>

                                <div class="form-group">
                                    <label for="size">Size:</label>
                                    <select name="size" id="size" class="form-control">
                                        <option value=""></option>

                                        <?php foreach ($size_array as $string) {
                                            $string_array = explode(':', $string);
                                            $quantity = $string_array[0];
                                            $quantiy = $string_array[1];
                                            echo '<option value="' . $size . '">' . $size . ' (' . $quantity . ' Available )</option>';
                                        } ?>
                                    </select>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" onclick="closemodal()">Close</button>
                <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span>Add to Cart</button>

            </div>
        </div>


    </div>
</div>

<script>
    function closemodal() {
        jQuery('#details-modal').modal('hide');
        setTimeout(function() {
            jQuery('#details-modal').remove();
        }, 500);
        jQuery('.modal-backdrop').remove();

    }
</script>
<? echo ob_get_clean(); ?>