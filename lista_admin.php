<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        session_start();
        if (!$_SESSION['isLogged']) {
            header("Location:http://localhost/es34_er/login.php");
        }
        include("connessione.php");
        $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
        $query = "SELECT username FROM Admin";
        $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    

        if(mysqli_num_rows($result) == 0){
            echo "<h1>La ricerca non ha fruttato nessun risultato</h1>";
        } else{
            echo"<div class =\"container\">
                    <div class=\"row\">
                        <div class=\"col col-6\">";
                        echo "<b>Utenti:</b>";
                        echo "<ul>";
                        while ($row = mysqli_fetch_assoc ($result)){
                            echo "<li>" . $row['username'] . "</li>";
                        }
                        echo "</ul>";
            echo "</div>
            <div class=\"col col-6 text-end\"><a href=\"index.php\">Torna alla home</a></div>
                </div>
            </div>";
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>