<!--Top Nav Bar-->
<?php
$sql = "SELECT * FROM  categories WHERE parent = 0";
$pquery = mysqli_query($db, $sql);
?>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <a href="index.php" class="navbar-brand"><img src="images/logo1.png" class=img-fluid></a>

        <ul class="nav navbar-nav">
            <!-- Menu Items-->
            <?php while ($parent = mysqli_fetch_assoc($pquery)) : ?>
                <?php
                $parent_id = $parent['id'];
                $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
                $cquery = mysqli_query($db, $sql2);

                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">

                        <?php while ($child = mysqli_fetch_assoc($cquery)) : ?>
                            <li><a href="#"><?php echo $child['category']; ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</nav>