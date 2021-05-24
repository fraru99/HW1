<?php

    require_once 'dbconfig.php';
    session_start();

    function checkAuth() {
        if(isset($_SESSION['sito_username'])) {
            return $_SESSION['sito_username'];
        } else 
            return 0;
    }
?>