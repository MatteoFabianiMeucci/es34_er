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
    ?>
    <div class="container">
        <div class="row">
            <div class="col col-4"></div>
            <div class = "border border-black rounded-4 w-25 mx-auto mt-5 col col-4">
                <form action="inserimento_nuovo_user.php" method="post" class= "py-5">
                    <label class = "text-center"><b>Digita le credenziali dell'account admin da creare</b></label>    
                    <label>Username:</label>
                    <br>
                    <input type="text" name = "username" required>
                    <br>
                    <label>Password:</label>
                    <br>
                    <input type="text" name = "password" required>
                    <br>
                    <br>
                    <input type="hidden" name="admin" value = "true">
                    <input type="submit" value="Invia">
                </form>
            </div>
            <div class="col col-4 text-end pt-5"><a href="index.php">Torna alla home</a></div>
        </div>
    </div>
    

   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>