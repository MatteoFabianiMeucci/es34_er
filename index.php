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
        session_start();
        if(count($_SESSION) == 0){
            $_SESSION['isLogged'] = false;
            $_SESSION['isAdmin'] = false;
            $_SESSION['userId'] = null;
            $_SESSION['adminId'] = null;
        }
    ?>
    <!-- inizio navbar -->
    <div>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img class = "home_button" src="navbar_home.png" alt="Bottone per tornare alla home"></a>
                <button class="navbar-toggler home_button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><img src="navbar_account_icon.png" alt="icona dell'account" class = "w-100 mx-auto"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <?php if(!$_SESSION['isLogged']):?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="login.php">Sign in</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="form_nuovo_utente.php">Sign up</a>
                                </li>
                            <?php elseif($_SESSION['isLogged'] && $_SESSION['isAdmin']):?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="form_nuovo_concerto.php">Aggiungi concerto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="lista_admin.php">Visualizza la lista degli admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="form_nuovo_admin.php">Crea nuovo admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="form_rimozione_admin.php">Rimuovi admin</a>
                                </li>
                            <?php else:?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="pagine_preferite.php">Visualizza le pagine preferite</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="form_rimozione_utente.php">Rimozione account</a>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- fine navbar -->
        <div class="container">
            <div class="row">
                <div class="col col-6 text-start">
                    <form action="ricerca_concerto.php" method="post">
                    <label>Inserisci il titolo del concerto che desideri ascoltare: </label>
                    <input type="search" name="concerto">
                    <input type="submit" value="cerca">
                    </form>
                </div>
                <div class="col col-6 text-start">
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
                            ?> 
                            <?php while ($row = mysqli_fetch_assoc ($result)):?>
                                <?php $nome = $row['Nome']?>
                                <?php echo "<option value=\"$nome\">$nome</option>" ?>
                            <?php endwhile;?>
                        </select>
                        <br>
                        <input type="submit" value="cerca">
                    </form>
                </div>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>