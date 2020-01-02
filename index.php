<!-- affiche les 5 derniers billets -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" media="screen" type="text/css" />
    <title>Billets</title>
</head>

<body>
    <h1>Mon super Blog !</h1>
    <h4>Derniers billets du blog :</h4>

    <?php
    // connection à la bdd
    include 'connection.php';


    // afficher le titre, la date et l'heure dans l'ordre descendant et limité a 5
    $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_crea FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
    while ($donnees = $req->fetch()) {
    ?>
        <div class="news">
            <h3><?= htmlspecialchars($donnees['titre']) ?> <i>le <?= htmlspecialchars($donnees['date_crea'])  ?></i></h3>
            <p><?= htmlspecialchars($donnees['contenu']) ?><br><a href="commentaires.php?billets=<?= $donnees['id']; ?>">Commentaires</a></p>
        </div>
    <?php
    }
    $req->closeCursor();
    ?>

    <h3></h3>

</body>

</html>