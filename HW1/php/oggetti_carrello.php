<?php

    require 'dbconfig.php';
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $query = "SELECT oggetti_carrello FROM credenziali WHERE username = '$userid'";

    $res = mysqli_query($conn, $query);

    
    $entry = mysqli_fetch_assoc($res);
    
    $eu_array = array('oggetti_carrello'=>$entry['oggetti_carrello']);


    echo json_encode($eu_array);
?>