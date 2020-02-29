<?php
include_once 'inc/config.php';
include_once 'inc/functions.php';

$connection = getConnection();

if (!isset($_POST['make_id'])) return false;

$models = getModelsByMakeId($connection, $_POST['make_id']);

echo json_encode($models);
