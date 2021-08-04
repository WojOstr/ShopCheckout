<?php
include ('connection.php');
include ('viewfunctions.php');
session_start();

$db = new database();
$discount = $_POST['discount'];
$vf = $_SESSION['vf'];

$result = $vf->checkDiscount($db->db_connection, $discount);

$_SESSION['Discount'] = $result;

echo json_encode($result);
