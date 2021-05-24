<?php

    include 'auth.php';
    if (checkAuth()) 
    {
        header('Location:  http://localhost/HW1/html/Mhw1.html');
        exit;
    }


    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $conn = mysqli_connect("localhost", "root", "", "homework")or die("errore: ".mysqli_connect_error());

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT id, username, password FROM credenziali WHERE username = '$username'";
        $res = mysqli_query($conn, $query)or die("error".  mysqli_error($conn));

        if(mysqli_num_rows($res)>0)
        {
            $entry = mysqli_fetch_assoc($res);

           if (password_verify($password, $entry['password']))
            {
                $_SESSION["sito_username"] = $entry['username'];
                $_SESSION["sito_utente_id"] = $entry['id'];
                
                header("Location:http://localhost/HW1/html/Mhw1.html");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }

        }
        else
        {
            $error = "username e/o password errati";
        }

  
    }
?>



<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/login.js" defer></script>
    <title>Pagina Login</title>
</head>
<body>
    <main>
        <h1>
            <em>ACCEDI</em><br>
            <p>-Il meraviglioso mondo dei treni ti attende!-</p>
        </h1>
        <img src="http://localhost/HW1/foto/postcard2.png">
        <form action = "login.php" name = 'form_dati' method="POST">
            <label>Nome Utente:</label>
            <div class="testo">
                <input type="text" name="username" id="username input">
                <p class="hidden username_error">Username non valido</p>
            </div>

            <label>Password:</label>
            <div class="testo">
                <input type="password" name="password" id="password input">
                <p class="hidden password_error">Password non valida</p>
            </div>

            <div class='invio'>
                <label>&nbsp<input type="submit" class="button"></label>
            </div>
        </form>
    </main>
    <?php
        if(isset($error)) 
        {
            echo "<span class='error'>$error</span>";
        }
    ?>
</body>
</html>