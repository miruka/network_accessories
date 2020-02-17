<?php

require_once '../core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';

//Get Brands from Database
$sql = "SELECT * FROM brand ORDER BY brand";
$results = mysqli_query($db, $sql);

$errors = array();

//Edit Brand
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = (int) $_GET['edit'];
    $edit_id = sanitize($edit_id);
    $sql2 = "SELECT * FROM brand WHERE id = '$edit_id'";
    $edit_result = mysqli_query($db, $sql2);
    $eBrand = mysqli_fetch_assoc($edit_result);


    # code...
}

//Delete Brand
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $delete_id = (int) $_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "DELETE FROM brand WHERE id = '$delete_id'";
    mysqli_query($db, $sql);
    header('Location: brands.php');
}


//If true ADD form is submitted
if (isset($_POST['add_submit'])) {
    $brand = sanitize($_POST['brand']);
    //Check if Brand is Blank
    if ($_POST['brand'] == '') {
        $errors[] .= 'You MUST ENTER a Brand';
    }
    //CHECK if brand exists in DATABASE
    $sql = "SELECT * FROM brand WHERE brand = '$brand'";
    if (isset($_GET['edit'])) {
        $sql = "SELECT * brand WHERE brand = '$brand' AND id != '$edit_id'";
        # code...
    }
    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $errors[] .= $brand . ' Brand Already Exists! Please Choose Another Brand';
    }


    //Display errors
    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        //ADD Brand to Database
        $sql = "INSERT INTO brand (brand) VALUES ('$brand')";
        if (isset($_GET['edit'])) {
            $sql = "UPDATE brand SET brand='$brand' WHERE id = '$edit_id'"; # code...
        }
        mysqli_query($db, $sql);
        header('Location: brands.php');
    }
}

?>
<h2 class="text-center">Brands Home</h2>
<hr>

<!--Brand Form-->
<div class="text-center">
    <form class="form-inline" action="brands.php<?= ((isset($_GET['edit'])) ? '?edit=' . $edit_id : ''); ?>" method="post">
        <div class="form-group">
            <?php
            $brand_value = '';
            if (isset($_GET['edit'])) {
                $brand_value = $eBrand['brand'];
                # code...
            } else {
                if (isset($_GET['brand'])) {
                    $brand_value = sanitize($_POST['brand']);
                    # code...
                }
            }

            ?>
            <label for="brand"><?= ((isset($_GET['edit'])) ? 'Edit' : 'Add a'); ?> Brand : </label>
            <input type="text" name="brand" id="brand" class="form-control" value="<?= $brand_value; ?>">
            <?php if (isset($_GET['edit'])) : ?>
                <a href="brands.php" class="btn btn-default">cancel</a>
            <?php endif; ?>
            <input type="submit" name="add_submit" value="<?= ((isset($_GET['edit'])) ? 'Edit' : 'Add'); ?>Brand" class="btn btn-success">

        </div>
    </form>
</div>
<hr>
<table class="table table-bordered table-striped table-auto table-condensed">
    <thead>
        <th></th>
        <th>Brand</th>
        <th></th>
    </thead>
    <tbody>
        <?php while ($brand = mysqli_fetch_assoc($results)) : ?>
            <tr>
                <td><a href="brands.php?edit=<?= $brand['id']; ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><?= $brand['brand']; ?></td>
                <td><a href="brands.php?delete=<?= $brand['id']; ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
include 'includes/footer.php';
?>