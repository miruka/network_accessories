<?php

require_once '../core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';

//Get Brands from Database
$sql = "SELECT * FROM brand ORDER BY brand";
$results = mysqli_query($db, $sql);

?>
<h2 class="text-center">Brands Home</h2>
<hr>
<table class="table table-bordered table-striped table-auto">
    <thead>
        <th></th>
        <th>Brand</th>
        <th></th>
    </thead>
    <tbody>
        <?php while ($brand = mysqli_fetch_assoc($results)) : ?>
            <tr>
                <td><a href="brands.php?edit=<?= $brand['id']; ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><?= $brand['brand'] ?></td>
                <td><a href="brands.php?delete=<?= $brand['id']; ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
include 'includes/footer.php';
?>