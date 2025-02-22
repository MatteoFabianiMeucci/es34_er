<?php
    session_start();
    $_SESSION['isLogged'] = false;
    $_SESSION['isAdmin'] = false;
    $_SESSION['userId'] = null;
    $_SESSION['adminId'] = null;
    header("Location:http://localhost/es34_er/index.php");
?>