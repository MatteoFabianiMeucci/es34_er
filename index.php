<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
    ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col col-8 text-start">
                <form action="ricerca_concerto.php" method="post">
                <label>Inserisci il titolo del concerto che desideri ascoltare: </label>
                <input type="search" name="concerto">
                <input type="submit" value="cerca">
                </form>

                <br><br><br>
                <form action="ricerca_orchestra.php" method="post">
                <label><b>Ricerca del direttore e degli orchestrali di un'orchestra</b></label>
                <br>
                <label>Nome dell'orchestra: </label>
                <select name="orchestra">
                    <?php
                        $concerto = $_POST['concerto'];
                        include("connessione.php");
                        $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
                        $query = "SELECT Nome FROM Orchestre";
                        $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
                        while ($row = mysqli_fetch_assoc ($result)){
                            $nome = $row['Nome'];
                            echo "<option value=\"$nome\">$nome</option>";
                        }
                    ?>
                </select>
                

                <br>
                <input type="submit" value="cerca">
                </form>
            </div>
            <?php
            if(count($_SESSION) == 0){
                $_SESSION['isLogged'] = false;
            }

            if ($_SESSION['isLogged'] == false) {
                echo "<div class=\"col col-4 text-end\">
                        <a href=\"login.php\">login</a>
                    </div>";
            } else{
                echo "<div class=\"col col-4 text-end\">
                        <a href=\"logout.php\">logout</a>
                        <br><br>
                        <a href=\"form_nuovo_concerto.php\">Aggiungi concerto</a>
                        <br>
                        <a href=\"lista_utenti.php\">Visualizza la lista degli admin</a>
                        <br>
                        <a href=\"form_nuovo_utente.php\">Crea nuovo utente</a>
                    </div>";
            }
            ?>
            
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>