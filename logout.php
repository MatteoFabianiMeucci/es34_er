<?php
    session_start();
    $_SESSION['isLogged'] = false;
    $_SESSION['isAdmin'] = false;
    header("Location:http://localhost/es34_er/index.php");
?>