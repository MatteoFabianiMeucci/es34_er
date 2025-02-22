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
    if ($_POST['admin'] == "true") {
        $query = "SELECT Username FROM Admin WHERE Username = \"$username\"";
        $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
        if(mysqli_num_rows($result) == 1){
            echo "<h1 class = \"text-center\">Utente già esistente</h1>
            <a href=\"index.php\">Torna alla home</a>";
        } else{
            $query = "INSERT INTO Admin (Username, Password) VALUES ('$username', '$password')"; 
            $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
            header("Location:http://localhost/es34_er/index.php");
        }
    }else{
        $query = "SELECT Username FROM Utenti WHERE Username = \"$username\"";
        $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
        var_dump(mysqli_num_rows($result));
        if(mysqli_num_rows($result) == 1){
            echo "<h1 class = \"text-center\">Utente già esistente</h1>
            <a href=\"index.php\">Torna alla home</a>";
        } else{
            $query = "INSERT INTO Utenti (Username, Password) VALUES ('$username', '$password')";
            $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
            header("Location:http://localhost/es34_er/index.php");
        }
        
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
