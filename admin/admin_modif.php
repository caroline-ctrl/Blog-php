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
    <a href="admin.php">Retour à la page admin</a>
    <?php
    include '../connection.php';

    // permet de récuperer le billet selectionné sur la page index.php
 $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_crea FROM billets WHERE id = ?');
 $req->execute(array($_GET['billets']));// permet de récuperer l'id qui est sur la page billets.
 $donnees = $req->fetch();
 ?>
 <div class="news">
        <h3><?= htmlspecialchars($donnees['titre']) ?> <i>le <?= htmlspecialchars($donnees['date_crea'])  ?></i></h3>
        <p><?= htmlspecialchars($donnees['contenu']) ?></p>
    </div>
   

<!-- FORMULAIRE DE MODIFICATION -->
    <form action="admin_modif1.php?billet=<?= $donnees['id']; ?>" method="post">

        <input type="hidden" name="id" value="<?= $donnees['id']; ?>">

        <br><label for="titre">Titre</label>
        <input type="text" name="titre" value="<?= $donnees['titre']; ?>"><br><br>

        <label for="contenu">Contenu</label>
        <textarea name="contenu" rows="8" cols="50" value="<?= $donnees['contenu']; ?>"><?= $donnees['contenu']; ?></textarea><br /><br /><br>

        

        <input type="submit">
    </form>

        
</body>
</html>