<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../style.css" rel="stylesheet" media="screen" type="text/css" />

    <title>Administrateur</title>
</head>
<body>
    
<h2>Ajout de billets</h2>

<?php
include '../connection.php';
?><a href="../index.php">Retour à la liste des billets</a><br><br><?php

if((isset($_POST['password']) AND $_POST['password'] == 'Tigrou') AND (isset($_POST['login']) AND $_POST['login'] == 'CaroD34*')){
    ?>

    <!-- pour ajouter un billet -->
    <form action="admin_ajout.php">
        <label>Ajouter un billet :</label>
        <input type="submit" value="Ajout"><br><br>
    </form>


    <?php 
    //recuperer les billets
    $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_crea FROM billets ORDER BY date_creation DESC');
    while ($donnees = $req->fetch()) {
    ?>
    <div class="news">
        <h3><?= htmlspecialchars($donnees['titre']) ?> <i>le <?= htmlspecialchars($donnees['date_crea'])  ?></i></h3>
        <p><?= htmlspecialchars($donnees['contenu']) ?><br><a href="admin_modif.php?billets=<?= $donnees['id']; ?>">Modifier</a><br><a href="admin_supp.php?billets=<?= $donnees['id']; ?>">Supprimer</a></p>
    </div>
<?php
}
$req->closeCursor();

}else{
    ?>
    <h4>Mauvais mot de passe ou mauvais identifiant, ressayez.</h4><br>
    <a href="../index.php">Retour à la liste des billets</a>
    <?php
}
?>


</body>
</html>