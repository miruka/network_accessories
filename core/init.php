<?php
$db = mysqli_connect('localhost', 'pmauser', 'Dypers1481*', 'network_accessories');
if (mysqli_connect_errno()) {
    echo 'Database Connection failed with the Following Errors: ' . mysqli_connect_error();
    die();
}

//define('BASEURL', '/network_accessories/');// This was the relative path
require_once $_SERVER['DOCUMENT_ROOT'] . '/network_accessories/config.php'; // Absolute path can be acessed by any file in the project

require_once BASEURL . '/helpers/helpers.php';
