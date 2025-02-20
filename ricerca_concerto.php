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
                        <td><?php echo $row['Titolo']; ?></td>
                        <td><?php echo $row['Descrizione']; ?></td>
                        <td><?php echo $row['Data']; ?></td>
                        <td><?php echo $row['NomeSala']; ?></td>
                        <td><?php echo $row['Capienza']; ?></td>
                        <td><?= $row['NomeOrchestra']; ?></td>
                        <td><a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </table>
        <a href="index.php">Torna alla home</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
