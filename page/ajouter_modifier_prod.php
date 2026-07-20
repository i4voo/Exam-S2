<?php
session_start();
include('../inc/function.php');
if (isset($_SESSION['id_membre'])) {
    $id_membre = $_SESSION['id_membre'];
}
$initiale = get_initiale_user($id_membre);
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
            <li><a href="statistique.php?id_membre=<?php echo $id_membre; ?>">Statistiques</a></li>
            <li><a href="../index.php">Déconnexion</a></li>
        </ul>
        <p>
            <span>[<?php echo $initiale; ?>]</span>
        </p>
    </nav>
<form action="traitement_ajout_modif_prod.php" method=post>
    <input type="hidden" name="idProd">
    <input type="text" name="nomProd" placeholder="Nom du produit">
    <input type="text" name="cate" placeholder="Categorie">
    <input type="text" name="prix" placeholder="Prix du produit">
    <input type="submit" value="Ajouter" name="choix">
    <input type="submit" value="Modifier" name="choix">
</form>
</body>
</html>