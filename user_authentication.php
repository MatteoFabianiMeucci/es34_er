<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    include("connessione.php");
    $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
    $query = "SELECT * FROM Utenti WHERE username = \"$username\" AND password = \"$password\"";
    $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    $count = mysqli_num_rows($result);

    if($count == 1){
        session_start();
        $_SESSION['isLogged'] = true;
        header("Location:http://localhost/es34_er/index.php");
    } else{
        header("Location:http://localhost/es34_er/login.php");
    }
?>