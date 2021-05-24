<?php

    require 'dbconfig.php';
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $pacchetto_id = mysqli_real_escape_string($conn, $_POST["pacchetto_id"]);





    $query = "SELECT id FROM credenziali WHERE username = '$userid'";
    $res_id = mysqli_query($conn, $query);
    $entry_id = mysqli_fetch_assoc($res_id);
    $id = $entry_id['id'];
    

    $query = "DELETE FROM carrello WHERE id_pacchetto = $pacchetto_id AND id_utente = $id";


    if (mysqli_query($conn, $query))
    {
        $returndata = array('ok' => true);
        echo json_encode($returndata);
        mysqli_close($conn);
        exit;
    }