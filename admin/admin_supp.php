<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">

    <title>Supprimer billet</title>
</head>
<body>
    <p>La suppression du billet a été réalisé avec succès !</p>
<a href="admin.php">Retour à la page admin</a>
<?php
include '../connection.php';

//requete permettant de supprimer un billet en fonction de son id
$req = $bdd->prepare('DELETE FROM billets WHERE id = ?');
$req->execute(array($_GET['billets']));


?>
    
    </body>
</html>