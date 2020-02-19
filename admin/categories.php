<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/network_accessories/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';

$sql = "SELECT * FROM categories WHERE parent = 0";
$result = mysqli_query($db, $sql);
$errors = array();

//Process Form
if (isset($_POST) && !empty($_POST)) {
    $parent = sanitize($_POST['parent']);
    $category = sanitize($_POST['category']);
    $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$parent'";
    $fresult = mysqli_query($db, $sqlform);
    $count = mysqli_num_rows($fresult);

    // Check if Category is Blank
    if ($category == '') {
        $errors[] .= 'The Category Cannot be Left BLANK';
    }

    //If Category exists in Database
    if ($count > 0) {
        $errors[] .= $category . ' Already Exists... PLEASE CHOOSE A NEW CATEGORY';
    }

    //Display Errors or UDPDATE DATABASE
    if (!empty($errors)) {
        $display = display_errors($errors); ?>
        <script>
            jQuery('document').ready(function() {
                jQuery('#erors').html('<?= $display; ?>');

            });
        </script>

<?php } else {
        //UPDATE DATABASE
        $updatesql = "INSERT INTO categories (category,parent) VALUES ('$category','$parent')";
        mysqli_query($db, $updatesql);
        header('Location: categories.php');
    }
}
?>
<h2 class="text-center">Categories</h2>
<hr>
<div class="row">
    <!-- Form -->
    <div class="col-md-6">
        <form class="form" action="categories.php" method="post">
            <legend>Add A Category</legend>
            <div id="erors"></div>
            <div class="form-group">
                <label for="parent">Parent</label>
                <select name="parent" id="parent" class="form-control">
                    <option value="0">Parent</option>
                    <?php while ($parent = mysqli_fetch_assoc($result)) : ?>
                        <option value="<?= $parent['id']; ?>"><?= $parent['category']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" name="category" id="category">
            </div>
            <div class="form-group">
                <input type="submit" value="Add Category" class="btn btn-success">
            </div>
        </form>

    </div>

    <!-- Categories Table -->
    <div class="col-md-6">
        <table class="table table-bordered ">
            <thead>
                <th>Category</th>
                <th>Parent</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM categories WHERE parent = 0";
                $result = mysqli_query($db, $sql);

                while ($parent = mysqli_fetch_assoc($result)) :
                    $parent_id = (int) $parent['id'];
                    $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
                    $cresult = mysqli_query($db, $sql2);
                ?>
                    <tr class="bg-primary">
                        <td><?= $parent['category']; ?></td>
                        <td>parent</td>
                        <td>
                            <a href="categories.php?edit=<?= $parent['id']; ?>" class="btn btn-xs  btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="categories.php?delete=<?= $parent['id']; ?>" class="btn btn-xs  btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                        </td>
                    </tr>
                    <?php while ($child = mysqli_fetch_assoc($cresult)) : ?>
                        <tr class="bg-info">
                            <td><?= $child['category']; ?></td>
                            <td><?= $parent['category']; ?></td>
                            <td>
                                <a href="categories.php?edit=<?= $child['id']; ?>" class="btn btn-xs  btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="categories.php?delete=<?= $child['id']; ?>" class="btn btn-xs  btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endwhile; ?>

            </tbody>
        </table>

    </div>


</div>


<?php include 'includes/footer.php'; ?>