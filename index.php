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
    ?>
    <!-- inizio navbar -->
    <div>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img class = "home_button" src="navbar_home.png" alt="Bottone per tornare alla home"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php
                            if(count($_SESSION) == 0){
                                $_SESSION['isLogged'] = false;
                                $_SESSION['isAdmin'] = false;
                            }
                        ?>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">    
                                <?php if($_SESSION['isLogged'] == false):?>
                                    <a class="nav-link active" aria-current="page" href="login.php">sign in</a>
                                <?php endif;?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            </div>
            </div>
        </nav>
    </div>
    <!-- fine navbar -->
        <div class="container">
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
                    $_SESSION['isAdmin'] = false;
                }
                ?>

                <div class="col col-4 text-end">
                    <?php
                        if ($_SESSION['isLogged'] == false){
                            echo "<a href=\"login.php\">sign in</a>
                            <br>
                                <a href=\"form_nuovo_utente.php\">sign up</a>";
                        } else if ($_SESSION['isLogged'] && $_SESSION['isAdmin']){
                            echo "<a href=\"logout.php\">logout</a>
                                <br><br>
                                <a href=\"form_nuovo_concerto.php\">Aggiungi concerto</a>
                                <br>
                                <a href=\"lista_admin.php\">Visualizza la lista degli admin</a>
                                <br>
                                <a href=\"form_nuovo_admin.php\">Crea nuovo admin</a>";
                        }else       {
                            echo "<a href=\"logout.php\">logout</a>
                                <br>
                                <a href=\"pagine_preferite.php\">Visualizza le pagine preferite</a>
                                <br><br>";
                        }
                    ?>
                </div>
                
            </div>
        </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>