<?php
    $descrizione = $_POST['descrizione'];
    $titolo = $_POST['titolo'];
    $data = $_POST['data'];
    $sala = $_POST['sala'];
    $orchestra = $_POST['orchestra'];

    include("connessione.php");
    $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
    $query = "INSERT INTO Concerti (Descrizione, Titolo, Data, IdSala, IdOrchestra) VALUES ('$descrizione', '$titolo', '$data', $sala, $orchestra)";
    $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    
    header("Location:http://localhost/ES34/index.php"); 
?>