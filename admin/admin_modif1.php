<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">

    <title>Modification billet</title>
</head>

<body>
    <a href="../index.php">Retour à la page d'accueil</a>
    <?php
    include '../connection.php';


    if (isset($_POST['titre']) AND isset($_POST['contenu'])){
		if (($_POST['titre'] != NULL) AND ($_POST['contenu'] != NULL)){	
			// Requête pour ajouter les infos dans la table
			$bdd->exec("UPDATE  billets SET titre = '" . $_POST['titre'] . "', contenu = '" . $_POST['contenu'] . "' WHERE id = '" . $_POST['id'] . "'");

       		}else {
            // Alerte si les 2 champs n'ont pas été rempli
			echo "<br>ATTENTION, Vous n'avez pas rempli tous les champs !";
		}
    }
    
    ?>
        
</body>
</html>