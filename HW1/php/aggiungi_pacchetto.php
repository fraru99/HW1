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
    

    $in_query = "INSERT INTO carrello(id_pacchetto, id_utente) 
                 VALUES($pacchetto_id,$id)";

    //$out_query = "SELECT n_acquisti FROM pacchetti WHERE id = $pacchetto_id";

    if (mysqli_query($conn, $in_query))
    {
        $returndata = array('ok' => true);
        echo json_encode($returndata);
        mysqli_close($conn);
        exit;
    }







    /*$pacchetto_id = mysqli_real_escape_string($conn, $_POST["pacchetto_id"]);

    $query = "SELECT id, nome, descrizione, sotto_descrizione, immagine, tipologia, prezzo FROM pacchetti WHERE id = $pacchetto_id";
    $res = mysqli_query($conn, $query);

    $eu_array = array();
    while($entry = mysqli_fetch_assoc($res))
    {
        $eu_array[] = array('id'=>$entry['id'], 'nome'=>$entry['nome'], 'descrizione'=>$entry['descrizione'], 'sotto_descrizione'=>$entry['sotto_descrizione'], 'immagine'=>$entry['immagine'], 'tipologia'=>$entry['tipologia'], 'prezzo'=>$entry['prezzo']);
    }


    echo json_encode($eu_array);*/
?>