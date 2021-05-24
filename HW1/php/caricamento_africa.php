<?php

    require 'dbconfig.php';
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $query = "SELECT id, nome, descrizione, sotto_descrizione, immagine, tipologia, prezzo FROM pacchetti WHERE tipologia = 'africa'";
    $res = mysqli_query($conn, $query);

    $eu_array = array();
    while($entry = mysqli_fetch_assoc($res))
    {
        $eu_array[] = array('id'=>$entry['id'], 'nome'=>$entry['nome'], 'descrizione'=>$entry['descrizione'], 'sotto_descrizione'=>$entry['sotto_descrizione'], 'immagine'=>$entry['immagine'], 'tipologia'=>$entry['tipologia'], 'prezzo'=>$entry['prezzo']);
    }


    echo json_encode($eu_array);
?>