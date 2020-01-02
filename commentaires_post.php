<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" media="screen" type="text/css" />
    <title>Ajout commentaire</title>
</head>

<body>
    <h1>Mon super Blog !</h1>
    <a href="commentaires.php?billets=<?=$_SESSION['billets']?>">Retour aux commentaires</a>


    <?php
    // connection à la bdd
    include 'connection.php';


    //verif que le formulaire est bien rempli
    if (isset($_POST['auteur']) AND isset($_POST['commentaire']))
	{
		if (($_POST['auteur'] != NULL) AND ($_POST['commentaire'] != NULL))
		{	
		 
			// Requête pour ajouter les infos dans la table
			$req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES (:id_billet, :auteur, :commentaire, NOW())');
    
    $req->execute(array(
        'id_billet'=> $_POST['id_billet'], 
        'auteur'=> $_POST['auteur'], 
        'commentaire'=> $_POST['commentaire'],
    ));

   		}
		else  // Alerte si les 2 champs n'ont pas été rempli
		{
			echo "<br>ATTENTION, Vous n'avez pas rempli tous les champs !";
		}
    }
    
	$req->closeCursor();
	?>

   
</body>

</html>