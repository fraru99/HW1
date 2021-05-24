<?php

    require 'dbconfig.php';
    $error = array();


    if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["mail"]) && !empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["conferma_password"]))
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT username FROM credenziali WHERE username = '$username'";
        $res = mysqli_query($conn, $query);

        if(mysqli_num_rows($res) > 0)
        {
            print_r(mysqli_num_rows($res));
            $error[0] = "username già in uso!";
        }
        if(strlen($_POST["password"]) <= 8)
        {
            $error[1] = "La password deve essere di almeno 8 caratteri!";
        }
        if(strcmp($_POST["password"], $_POST["conferma_password"]) != 0)
        {
            $error[2] = "Le password inserite non corrispondono!";
        }

        $mail = mysqli_real_escape_string($conn, $_POST['mail']);
        $query = "SELECT mail FROM credenziali WHERE mail = '$mail'";
        $res = mysqli_query($conn, $query);

        if(mysqli_num_rows($res) > 0)
        {
            print_r(mysqli_num_rows($res));

            $error[3] = "mail già in uso!";
        }

        

        if(count($error) == 0)
        {
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO credenziali(username, password, mail, nome, cognome)
                     VALUES('$username','$password','$mail','$nome', '$cognome')";

            if(mysqli_query($conn, $query))
            {
                $_SESSION["sito_username"] = $_POST['username'];
                $_SESSION["sito_utente_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: http://localhost/HW1/html/Mhw1.html");
            }             
        }

    }
    else if (isset($_POST["username"])) 
    {
        $error[4] = "Riempi tutti i campi";
    }

?>



<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registrazione.css">
    <script src="../js/registrazione.js" defer></script>
    <title>Pagina Registrazione</title>
</head>
<body>
    <h1>-REGISTRATI-</h1>
    <main>
        <img src="../foto/cartolina.jpg" class="shadow-box">
        <form action = "registrazione.php" name = 'form_dati_registrazione' method="POST">

            <label>Nome:</label>
            <div class="testo">
                <input type="text" name="nome" id="nome input">
                <p class="hidden nome_error">Nessun nome inserito!</p>
            </div>

            <label>Cognome:</label>
            <div class="testo">
                <input type="text" name="cognome" id="cognome input">
                <p class="hidden cognome_error">Nessun cognome inserito!</p>
            </div>

            <label>Username:</label>
            <div class="testo">
                <input type="text" name="username" id="username input" placeholder="Max.15 caratteri">
                <p class="hidden username_error">errore</p>
            </div>

            <label>E-Mail:</label>
            <div class="testo">
                <input type="text" name="mail" id="mail input">
                <p class="hidden mail_error">errore</p>
            </div>

            <label>Password:</label>
            <div class="testo">
                <input type="password" name="password" id="password input" placeholder="min 8 caratteri">
                <p class="hidden password_error">la password ha meno di 8 caratteri!</p>
            </div>

            <label>Conferma Password:</label>
            <div class="testo">
                <input type="password" name="conferma_password" id="conferma_password input">
                <p class="hidden password_confirm_error">le password non coincidono!</p>
            </div>
            <div class='invio'>
                <label>&nbsp<input type="submit" class="button"></label>
            </div>
        </form>
    </main>
    <div id="accedi">
        <p>Hai un account?</p>
        <a href="login.php">Accedi</a>
    </div>
    <?php
        if (isset($error[4])) 
        {
            echo "<span>$error[4]</span>";
        }
    ?>
</body>
</html>