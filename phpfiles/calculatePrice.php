<?php
include 'connection.php';
include 'viewfunctions.php';
session_start();

$db = new database();
$discount = $_POST['discount'];
$productid = $_POST['productid'];
$shippment = $_POST['shippment'];
$quantity = $_POST['quantity'];
$vf = $_SESSION['vf'];

$result = $vf->calculateprice($db->db_connection, $productid, $shippment, $discount, $quantity);

$_SESSION['finalprice'] = $result;

echo json_encode($result);
