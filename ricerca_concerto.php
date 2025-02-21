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
        $concerto = $_POST['concerto'];
        include("connessione.php");
        $connessione = mysqli_connect($host, $user, $pass, $db)
            or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
        $query = "SELECT Concerti.Id, Titolo, Descrizione, Data, Sale.Nome AS NomeSala, Capienza, Orchestre.Nome as NomeOrchestra, IdOrchestra FROM Concerti JOIN Sale ON (Concerti.IdSala = Sale.Id) JOIN Orchestre ON (Concerti.IdOrchestra = Orchestre.Id) WHERE Titolo LIKE \"%$concerto%\"";
        $result = mysqli_query($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    ?>
    <div>
        <table class="mx-auto text-center w-100">
            <?php if (mysqli_num_rows($result) == 0): ?>
                <h1>La ricerca non ha fruttato nessun risultato</h1>
            <?php else: ?>
                <tr>
                    <th>Titolo</th>
                    <th>Descrizione</th>
                    <th>Data</th>
                    <th>Sala</th>
                    <th>Capienza della sala</th>
                    <th>Orchestra</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['Titolo']; ?></td>
                        <td><?= $row['Descrizione']; ?></td>
                        <td><?= $row['Data']; ?></td>
                        <td><?= $row['NomeSala']; ?></td>
                        <td><?= $row['Capienza']; ?></td>
                        <td><?= $row['NomeOrchestra']; ?></td>
                        <?php if ($_SESSION['isLogged'] && !$_SESSION['isAdmin']): ?>
                            <td>
                                <form action="aggiunta_ai_preferiti.php" method="post">
                                    <input type="hidden" name="idConcerto" value = "<?=$row['Id'];?>">  
                                    <input type="hidden" name="idUtente" value = "<?=$_SESSION['userId'];?>">
                                    <input type="submit" value="Metti nei preferiti">
                                </form>
                            </td>
                        <?php endif;?>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </table>
        <a href="index.php">Torna alla home</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
