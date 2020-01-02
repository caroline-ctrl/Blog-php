<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" media="screen" type="text/css" />

    <title>Administrateur</title>
</head>
<body>
    
<h2>Ajout de billets</h2>

<?php
include 'connection.php';
?><a href="index.php">Retour à la liste des billets</a><br><br><?php

if(isset($_POST['password']) AND $_POST['password'] == 'Tigrou'){
    ?>
    <!-- formulaire permettant d'ajouter un billet -->
    <form action="admin_post.php" method="post">
    
        <label for="titre">Titre</label>
        <input type="text" name="titre"><br><br>

        <label for="contenu">Contenu</label>
        <textarea name="contenu"></textarea><br><br>

        <input type="submit">
    </form>

    <?php

}else{
    ?>
    <h4>Mauvais mot de passe, ressayez.</h4><br>
    <a href="index.php">Retour à la liste des billets</a>
    <?php
}
?>


</body>
</html>