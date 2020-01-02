<?php
session_start();
$_SESSION['billets'] = $_GET['billets'];
?>
<!-- affiche un billet et ses commentaires -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" media="screen" type="text/css" />
    <title>Commentaires</title>
</head>

<body>
    <h1>Mon super Blog !</h1>
    <a href="index.php">Retour à la liste des billets</a>

    <?php
    // connection à la bdd
    include 'connection.php';


    // permet de récuperer le billet selectionné sur la page index.php
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_crea FROM billets WHERE id = ?');
    $req->execute(array($_GET['billets']));// permet de récuperer l'id qui est sur la page billets.
    $donnees = $req->fetch();

    //verifie que le billet demandé existe, si oui les com sont visible ainsi que le formulaire sinon, message d'erreur
    if(empty($donnees)){
        echo "<br><strong>Ce billet n'existe pas</strong>";
    }else{
        ?>
<div class="news">
        <h3><?= htmlspecialchars($donnees['titre']) ?> <i>le <?= htmlspecialchars($donnees['date_crea'])  ?></i></h3>
        <p><?= htmlspecialchars($donnees['contenu']) ?></p>
    </div>

    <h2>Commentaires</h2>
    <?php
     $req->closeCursor();
    // affiche les commentaires liés au billet selectionné
    $com = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%imin%ss") AS date_com FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
    $com->execute(array($_GET['billets']));
    while($essaie = $com->fetch()){
        ?>
        <p><strong><?= htmlspecialchars($essaie['auteur']) ?></strong> le <?= htmlspecialchars($essaie['date_com'])  ?><br>
        <?= htmlspecialchars($essaie['commentaire']) ?></p>

    <?php
    }
    $req->closeCursor();
    ?>
    

    <!-- formulaire permettant d'ajouter un commentaire au billet -->
    <h1>Ajouter un commentaire au billet</h1>
    <form action="commentaires_post.php?billet=<?= $donnees['id']; ?>" method="post">
    
        <label for="nom">Votre nom</label>
        <input type="text" name="auteur"><br><br>

        <label for="commentaire">Votre commentaire</label>
        <textarea name="commentaire"></textarea><br><br>

        <input type="hidden" name="id_billet" value="<?= $donnees['id']; ?>">

        <input type="submit">
    </form>
<?php
    }
    ?>

    




    

        
    
    


</body>

</html>