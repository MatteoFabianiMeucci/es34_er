<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash('sha256', $password);
    $isAdmin = isset($_POST['admin']);
    include("connessione.php");
    $connessione = mysqli_connect($host, $user, $pass, $db) or die ("<br>Errore di connessione" . mysqli_error($connessione) . " ". mysqli_errno($connessione));
    if(!$isAdmin)
        $query = "SELECT Password FROM Utenti WHERE Username = \"$username\" AND Password = \"$password\"";
    else
        $query = "SELECT Password FROM Admin WHERE Username = \"$username\" AND Password = \"$password\"";

    $result = mysqli_query ($connessione, $query) or die ("Query fallita " . mysqli_error($connessione) . " " . mysqli_errno($connessione));
    $count = mysqli_num_rows($result);

    if($count == 1){
        session_start();
        $_SESSION['isLogged'] = true;
        if($isAdmin){
            $_SESSION['isAdmin'] = true;
            echo "ci entra";    
        }
        header("Location:http://localhost/es34_er/index.php");
    } else{
        header("Location:http://localhost/es34_er/login.php");
    }
?>