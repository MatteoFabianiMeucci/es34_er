<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash('sha256', $password);
    include("connessione.php");
    $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
    $query = "SELECT Id FROM Utenti WHERE Username = \"$username\" AND Password = \"$password\"";
    $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $id = $row['Id'];
        $query = "DELETE FROM Concerti_Utenti WHERE IdUtente = \"$id\"";
        $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
        $query = "DELETE FROM Utenti WHERE Username = \"$username\" AND Password = \"$password\"";
        $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
        session_start();
        if($id == $_SESSION['userId']){
            $_SESSION['isLogged'] = false;
            $_SESSION['userId'] = null;
        }
        header("Location:http://localhost/es34_er/index.php");
        
    } else{
        echo "<h1 class = \"text-center\">Username o password sbagliati</h1>
            <a href=\"form_rimozione_utente.php\">Ritenta</a>
            <a href=\"index.php\">Torna alla home</a>";
    }

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
