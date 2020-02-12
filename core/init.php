<?php
$db = mysqli_connect('localhost', 'pmauser', 'Dypers1481*', 'network_accessories');
if (mysqli_connect_errno()) {
    echo 'Database Connection failed with the Following Errors: ' . mysqli_connect_error();
    die();
}

define('BASEURL', '/network_accessories/');
