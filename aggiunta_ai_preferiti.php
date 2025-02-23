<?php
    if(!isset($_POST['idUtente']) || !isset($_POST['idConcerto']))
        header("Location:http://localhost/es34_er/index.php");
    session_start();
    if($_SESSION['isAdmin'])
        header("Location:http://localhost/es34_er/index.php");
    $idUtente = $_POST['idUtente'];
    $idConcerto = $_POST['idConcerto'];
    include("connessione.php");
    $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
    $query = "INSERT INTO Concerti_Utenti (IdConcerto, IdUtente) VALUES ($idConcerto, $idUtente)";
    $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    $_SESSION['concerto'] = $_POST['concerto'];
    $_SESSION['ricorda_concerto'] = true;
    header("Location:http://localhost/es34_er/ricerca_concerto.php");
?>