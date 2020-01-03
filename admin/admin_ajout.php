<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="admin.php">Retour page admin</a>
<?php
include '../connection.php';
?>

<!-- formulaire permettant d'ajouter un billet -->
<form action="admin_ajout.php" method="post">
    
    <br><label for="titre">Titre</label>
    <input type="text" name="titre"><br><br>

    <label for="contenu">Contenu</label>
    <textarea name="contenu"></textarea><br><br>

    <input type="submit">
</form>

<?php


 //verif que le formulaire est bien rempli
 if (isset($_POST['titre']) AND isset($_POST['contenu']))
 {
     if (($_POST['titre'] != NULL) AND ($_POST['contenu'] != NULL))
     {	
      
         // Requête pour ajouter les infos dans la table
         $req = $bdd->prepare('INSERT INTO billets (titre, contenu, date_creation) VALUES (:titre, :contenu, NOW())');
 
 $req->execute(array(
     'titre'=> $_POST['titre'], 
     'contenu'=> $_POST['contenu'],
 ));



        }
     else  // Alerte si les 2 champs n'ont pas été rempli
     {
         echo "<br>ATTENTION, Vous n'avez pas rempli tous les champs !";
     }
 }
 

 ?>

    
</body>
</html>