<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    include("connessione.php");
    $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
    $query = "INSERT INTO Utenti (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    
    header("Location:http://localhost/es34_er/index.php"); 
?>