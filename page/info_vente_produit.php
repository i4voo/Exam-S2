<?php
session_start();
include('../inc/function.php');
if (isset($_SESSION['id_membre'])) {
    $id_membre = $_SESSION['id_membre'];
}
$initiale = get_initiale_user($id_membre);
$id_cat =$_GET['id_cat'];
$info_vente_prod= info_vente_prod($id_cat);
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

    <table>
        <tr>
            <th>Produit</th>
            <th>Quantite</th>
        </tr>

        <?php foreach($info_vente_prod as $i){?>
        <tr>
            <td><a href="info_vente_membre.php?idProd=<?php echo $i['idProd'];?>"><?php echo $i['nomProd'];?></a></td>
            <td><?php echo $i['quantite'];?></td>
            
        </tr>
        <?php } ?>
    </table>
</body>
</html>