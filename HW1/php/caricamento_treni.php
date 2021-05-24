<?php

    require 'dbconfig.php';
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $query = "SELECT * FROM treno";
    $res = mysqli_query($conn, $query);

    $treni_array = array();
    while($entry = mysqli_fetch_assoc($res))
    {
        $treni_array[] = array('nome'=>$entry['nome'], 'descrizione'=>$entry['descrizione'], 'immagine'=>$entry['immagine']);
    }

    echo json_encode($treni_array);
?>