<?php
    session_start();
    if($_SESSION['isAdmin'])
        header("Location:http://localhost/es34_er/index.php");
    $idUtente = $_POST['idUtente'];
    $idConcerto = $_POST['idConcerto'];
    include("connessione.php");
    $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
    $query = "DELETE FROM Concerti_Utenti WHERE IdConcerto = \"$idConcerto\" AND IdUtente = \"$idUtente\"";
    $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    $_SESSION['concerto'] = $_POST['concerto'];
    $_SESSION['ricorda_concerto'] = true;
    header("Location:http://localhost/es34_er/ricerca_concerto.php");
?>