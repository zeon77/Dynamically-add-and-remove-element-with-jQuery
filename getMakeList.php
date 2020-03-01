<?php
include_once 'inc/config.php';
include_once 'inc/functions.php';

$connection = getConnection();

//if (!isset($_POST['make_id'])) return false;

$makeList = getMakeList($connection);

echo json_encode($makeList);
