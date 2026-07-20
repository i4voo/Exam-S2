<?php
session_start();
include('../inc/function.php');
if (isset($_SESSION['id_membre'])) {
    $id_membre = $_SESSION['id_membre'];
}
$initiale = get_initiale_user($id_membre);
$categorie = all_categorie();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../asset/style.css">
    <title>Document</title>
</head>
<body>
<nav>
        <ul>
            <li><a href="accueil.php?id_membre=<?php echo $id_membre; ?>">Accueil</a></li>
            <li><a href="vendre.php?id_membre=<?php echo $id_membre; ?>">Vendre un produit</a></li>
            <li><a href="ventes.php?id_membre=<?php echo $id_membre; ?>">Mes ventes</a></li>
            <li><a href="#">Statistiques</a></li>
            <li><a href="../index.php">Déconnexion</a></li>
        </ul>
        <p>
            <span>[<?php echo $initiale; ?>]</span>
        </p>
    </nav>

  
    <h1>Ventes par categorie</h1>
    <ul>
        <?php foreach($categorie as $c){?>
            <li><a href="info_vente_produit.php?id_cat=<?php echo $c['id_categorie'];?>"><?php echo $c['nom_categorie'];?></a></li>
        <?php } ?>
    </ul>
</body>
</html>