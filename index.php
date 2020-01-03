<!-- affiche les 5 derniers billets -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Billets</title>
</head>

<body>
    <h1>Mon super Blog !</h1>
    <h4>Derniers billets du blog :</h4>

    <?php
    // connection à la bdd
    include 'connection.php';

    //Récupère la page via une requête GET, s'il n'existe pas par défaut la page à 1
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
    // Nombre de billets a afficher sur chaque page
    $records_per_page = 5;
    // afficher les billets par le titre, la date et l'heure dans l'ordre descendant et limité a 5
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_crea FROM billets ORDER BY date_creation DESC LIMIT :current_page, :record_per_page');
    $req->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
    $req->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
    $req->execute();

    while ($donnees = $req->fetch()) {
    ?>
        <div class="news">
            <h3><?= htmlspecialchars($donnees['titre']) ?> <i>le <?= htmlspecialchars($donnees['date_crea'])  ?></i></h3>
            <p><?= htmlspecialchars($donnees['contenu']) ?><br><a href="commentaires.php?billets=<?= $donnees['id']; ?>">Commentaires</a></p>
        </div>
    <?php
    }
    $req->closeCursor();

    // permet d'obtenir le nombre total de billets
    $num_contacts = $bdd->query('SELECT COUNT(*) FROM billets')->fetchColumn();
    ?>

<!-- petit simbole en bas pour tourner les pages de billet -->
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="index.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <?php endif; ?>
            <?php if ($page * $records_per_page < $num_contacts) : ?>
                <a href="index.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
            <?php endif; ?>
        </div>




<!-- pour se connecter en tant qu'admin -->
    <h2>Accès administrateur</h2>
    <form action="admin/admin.php" method="post">
    <label for="login">Identifiant : </label>
        <input id="login" type="text" name="login"><br>
        <label for="pass">Mot de passe : </label>
        <input id="motPasse" type="password" name="password">
        <span id="but"> VOIR </span><br>
        <input type="submit"><br>
    </form>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html>