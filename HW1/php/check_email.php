<?php

    
    require 'dbconfig.php';

    header("Content-Type: application/json");



    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $mail = mysqli_real_escape_string($conn, $_POST['check_mail']);
    $query = "SELECT mail FROM credenziali WHERE mail = '$mail'";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0)
    {
        $returndata = array('ok' => false);
        echo json_encode($returndata);

    }
    else{
        $returndata = array('ok' => true);
        echo json_encode($returndata);

    }

    mysqli_close($conn);
    exit;

?>