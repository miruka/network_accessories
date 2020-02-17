<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/network_accessories/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
?>
<h2 class="text-center">Categories</h2>
<hr>
<div class="row">
    <div class="col-md-6">

    </div>
    <div class="col-md-6">
        <table class="table table-bordered ">
            <thead>
                <th>Category</th>
                <th>Parent</th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td>cisco</td>
                    <td>Routers</td>
                    <td>
                        <a href="categories.php?edit=1" class="btn btn-xs  btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="categories.php?delete=1" class="btn btn-xs  btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                    </td>
                </tr>
            </tbody>

        </table>

    </div>


</div>


<?php include 'includes/footer.php'; ?>