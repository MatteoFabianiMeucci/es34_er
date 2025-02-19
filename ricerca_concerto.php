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
        $concerto = $_POST['concerto'];
        include("connessione.php");
        $connessione = mysqli_connect($host, $user, $pass, $db)
            or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
        $query = "SELECT Titolo, Descrizione, Data, Sale.Nome AS NomeSala, Capienza, Orchestre.Nome as NomeOrchestra, IdOrchestra FROM Concerti JOIN Sale ON (Concerti.IdSala = Sale.Id) JOIN Orchestre ON (Concerti.IdOrchestra = Orchestre.Id) WHERE Titolo LIKE \"%$concerto%\"";
        $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    ?>
    <div>
        <table class = "mx-auto text-center w-100">
            <?php
                if(mysqli_num_rows($result) == 0){
                    echo "<h1>La ricerca non ha fruttato nessun risultato</h1>";
                } else{
                    echo "<tr>";
                    echo "<th>Titolo</th>";
                    echo "<th>Descrizione</th>";
                    echo "<th>Data</th>";
                    echo "<th>Sala</th>";
                    echo "<th>Capienza della sala</th>";
                    echo "<th>Orchestra</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc ($result)){
                        echo "<tr>";
                        echo "<td>" . $row['Titolo'] . "</td>";
                        echo "<td>" . $row['Descrizione'] . "</td>";
                        echo "<td>" . $row['Data'] . "</td>";
                        echo "<td>" . $row['NomeSala'] . "</td>";
                        echo "<td>" . $row['Capienza'] . "</td>";
                        echo "<td>" . $row['NomeOrchestra'] . "</td>";
                        echo "</tr>";
                    }
                }  
            ?>
        </table>
        <a href="index.php">Torna alla home</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>