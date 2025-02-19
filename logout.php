<?php
    session_start();
    $_SESSION['isLogged'] = false;
    header("Location:http://localhost/ES34/index.php");
?>