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
    <div class = "text-center">
        <?php
            $orchestra = $_POST['orchestra'];
            echo "<h1>$orchestra</h1>"
        ?>
    </div>
    <div class="container">
        <div class="row">
            <div class = "col col-6">
                <b>Direttore:</b> 
                <?php
                    include("connessione.php");
                    $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
                    $query = "SELECT InfoDirettori.Nome, InfoDirettori.Cognome FROM Orchestre JOIN InfoDirettori ON (Orchestre.Direttore = InfoDirettori.Id) WHERE Orchestre.Nome = \"$orchestra\"";
                    $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
                    $row = mysqli_fetch_assoc ($result);
                    echo "<span>" . $row['Cognome'] . " " . $row['Nome'] ."</span>";
                ?>
            </div>


            <div class = "col col-6">
                <b>Orchestrali:</b>
                <ul>
                    <?php
                        $orchestra = $_POST['orchestra'];
                        include("connessione.php");
                        $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
                        $query = "SELECT InfoOrchestrali.Nome, InfoOrchestrali.Cognome FROM Orchestre JOIN Orchestre_Orchestrali ON (Orchestre.Id = Orchestre_Orchestrali.IdOrchestra) JOIN InfoOrchestrali ON (InfoOrchestrali.Id = Orchestre_Orchestrali.IdOrchestrale) WHERE Orchestre.Nome = \"$orchestra\"";
                        $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
                        while ($row = mysqli_fetch_assoc ($result)){
                            echo "<li>" . $row['Cognome'] . " " .  $row['Nome'] . "</li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    
    
    <div>
        <a href="index.php">Torna alla home</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>