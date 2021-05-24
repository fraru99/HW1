<?php

    require 'dbconfig.php';
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header("Content-Type: application/json");

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    $query_id = "SELECT id FROM credenziali WHERE username = '$userid'";
    $res_id = mysqli_query($conn, $query_id);
    $entry_id = mysqli_fetch_assoc($res_id);
    $id = $entry_id['id'];



    $query = "SELECT * FROM carrello JOIN pacchetti ON carrello.id_pacchetto = pacchetti.id WHERE carrello.id_utente = $id";
    $res = mysqli_query($conn, $query);

    $eu_array = array();
    while($entry = mysqli_fetch_assoc($res))
    {
        $eu_array[] = array('id'=>$entry['id'], 'nome'=>$entry['nome'], 'descrizione'=>$entry['descrizione'], 'sotto_descrizione'=>$entry['sotto_descrizione'], 'immagine'=>$entry['immagine'], 'tipologia'=>$entry['tipologia'], 'prezzo'=>$entry['prezzo']);
    }


    echo json_encode($eu_array);
?>