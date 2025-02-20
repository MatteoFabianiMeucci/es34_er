<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash('sha256', $password);
    include("connessione.php");
    $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
    if ($_POST['admin'] == "true") {
        $query = "INSERT INTO Admin (Username, Password) VALUES ('$username', '$password')"; 
    }else{
        $query = "INSERT INTO Utenti (Username, Password) VALUES ('$username', '$password')";
    }
    $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    
    header("Location:http://localhost/es34_er/index.php"); 
?>