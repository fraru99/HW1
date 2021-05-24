<?php

    
    require 'dbconfig.php';

    header("Content-Type: application/json");



    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $username = mysqli_real_escape_string($conn, $_POST['check_username']);
    $query = "SELECT username FROM credenziali WHERE username = '$username'";
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