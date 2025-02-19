<?php
    session_start();
    $_SESSION['isLogged'] = false;
    header("Location:http://localhost/es34_er/index.php");
?>