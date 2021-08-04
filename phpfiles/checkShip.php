<?php
// Sprawdzanie przesyłki w frontendzie
include ('connection.php');
include ('viewfunctions.php');
session_start();

$db = new database();
$ship = $_POST['ship'];
$vf = $_SESSION['vf'];

$result = $vf->viewShip($db->db_connection, $ship);

$_SESSION['shipPrice'] = $result;

echo json_encode($result);
